<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Students</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Registered Students</h2>

<table border="1"
width="100%"
cellpadding="10">

<tr>
<th>Name</th>
<th>Student ID</th>
<th>Department</th>
<th>Voted</th>
</tr>

<?php

$result =
$conn->query(
"SELECT * FROM students"
);

while($row =
$result->fetch_assoc()){

?>

<tr>

<td>
<?php echo $row['fullname']; ?>
</td>

<td>
<?php echo $row['student_id']; ?>
</td>

<td>
<?php echo $row['department']; ?>
</td>

<td>
<?php echo $row['has_voted']
? 'Yes'
: 'No'; ?>
</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>