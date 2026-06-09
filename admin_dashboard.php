<?php
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Admin Dashboard</h2>

<ul>

<li>
<a href="manage_candidates.php">
Manage Candidates
</a>
</li>

<li>
<a href="manage_students.php">
View Students
</a>
</li>

<li>
<a href="results.php">
Election Results
</a>
</li>

<li>
<a href="reset_election.php">
Reset Election
</a>
</li>

<li>
<a href="admin_logout.php">
Logout
</a>
</li>

</ul>

</div>

</body>
</html>