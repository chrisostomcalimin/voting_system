
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

<form method="POST" action="login.php">

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
