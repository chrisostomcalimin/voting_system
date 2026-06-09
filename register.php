<?php
include "config/db.php";

$message = "";

if(isset($_POST['register'])){

    $fullname = trim($_POST['fullname']);
    $student_id = trim($_POST['student_id']);
    $email = trim($_POST['email']);
    $department = trim($_POST['department']);

    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check passwords match
    if($password != $confirm_password){

        $message = "Passwords do not match.";

    } else {

        // Check Student ID already exists
        $check = $conn->prepare(
            "SELECT id FROM students WHERE student_id=?"
        );

        $check->bind_param("s", $student_id);
        $check->execute();
        $result = $check->get_result();

        if($result->num_rows > 0){

            $message = "Student ID already registered.";

        } else {

            $hashedPassword =
                password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );

            $insert = $conn->prepare(
                "INSERT INTO students
                (fullname, student_id, email, password, department)
                VALUES (?, ?, ?, ?, ?)"
            );

            $insert->bind_param(
                "sssss",
                $fullname,
                $student_id,
                $email,
                $hashedPassword,
                $department
            );

            if($insert->execute()){

                $message = "Registration successful.";

            } else {

                $message = "Registration failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Student Registration</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Student Registration</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input
type="text"
name="fullname"
placeholder="Full Name"
required>

<input
type="text"
name="student_id"
placeholder="Student ID"
required>

<input
type="email"
name="email"
placeholder="Email Address"
required>

<input
type="text"
name="department"
placeholder="Department/Course"
required>

<input
type="password"
name="password"
placeholder="Password"
required>

<input
type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button
type="submit"
name="register">
Register
</button>

</form>

</div>

</body>
</html>