<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

if(isset($_POST['add'])){

    $name = $_POST['name'];
    $position = $_POST['position'];
  $photo = $_FILES['photo']['name'];

    move_uploaded_file(
        $_FILES['photo']['tmp_name'],
        "uploads/".$photo
    );

    $stmt = $conn->prepare(
        "INSERT INTO candidates(name,position)
         VALUES(?,?)"
    );

    $stmt->bind_param(
        "ss",
        $name,
        $position
    );

    $stmt->execute();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Candidates</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Manage Candidates</h2>

<form method="POST" enctype="multipart/form-data">
<input type="text"
name="name"
placeholder="Candidate Name"
required>

<input type="text"
name="position"
placeholder="Position"
required>

<input
type="file"
name="photo"
required>

<button name="add">
Add Candidate
</button>

</form>

<hr>

<?php

$result =
$conn->query(
"SELECT * FROM candidates"
);

while($row = $result->fetch_assoc()){

echo $row['name'];
echo " - ";
echo $row['position'];
echo "<br>";
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</div>

</body>
</html>