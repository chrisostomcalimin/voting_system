<?php
session_start();
include "config/db.php";

$message = "";

if(isset($_POST['login'])){

    $student_id = trim($_POST['student_id']);
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM students WHERE student_id=?"
    );

    $stmt->bind_param("s", $student_id);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $student = $result->fetch_assoc();

        if(password_verify(
            $password,
            $student['password']
        )){

            $_SESSION['student_id'] = $student['id'];
            $_SESSION['fullname'] = $student['fullname'];

            header("Location: vote.php");
            exit();

        }else{

            $message = "Invalid password.";
        }

    }else{

        $message = "Student ID not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Student Login</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input
type="text"
name="student_id"
placeholder="Student ID"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<button
type="submit"
name="login">
Login
</button>

</form>

</div>

</body>
</html>