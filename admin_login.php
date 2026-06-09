<?php
session_start();
include "config/db.php";

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare(
        "SELECT * FROM admins WHERE username=?"
    );

    $stmt->bind_param("s",$username);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $admin = $result->fetch_assoc();

        if(password_verify(
            $password,
            $admin['password']
        )){

            $_SESSION['admin_id'] = $admin['id'];

            header("Location: admin_dashboard.php");
            exit();
        }
    }

    $message = "Invalid Login";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Admin Login</h2>

<p><?php echo $message; ?></p>

<form method="POST">

<input type="text"
name="username"
placeholder="Username"
required>

<input type="password"
name="password"
placeholder="Password"
required>

<button name="login">
Login
</button>

</form>

</div>

</body>
</html>