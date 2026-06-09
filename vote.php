<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

$studentId = $_SESSION['student_id'];

$studentQuery = $conn->query(
    "SELECT * FROM students WHERE id=$studentId"
);

$student = $studentQuery->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Voting System</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Student Election</h2>

<p>Welcome, <?php echo $_SESSION['fullname']; ?></p>

<hr>

<?php
if($student['has_voted'] == 1){
    echo "<h3 style='color:red;'>You have already voted.</h3>";
} else {

    $candidates = $conn->query(
        "SELECT * FROM candidates"
    );
?>

<form action="cast_vote.php" method="POST">

<?php
while($row = $candidates->fetch_assoc()){
?>

<label>

<input
type="radio"
name="candidate_id"
value="<?php echo $row['id']; ?>"
required>

<strong><?php echo $row['name']; ?></strong>

<br>

Position:
<?php echo $row['position']; ?>

</label>

<hr>

<?php
}
?>

<button type="submit">
Cast Vote
</button>

</form>

<?php
}
?>
<hr>

<h3>Voting Progress</h3>

<div class="stats">

<p>
Registered Students:
<span id="registered">0</span>
</p>

<p>
Votes Cast:
<span id="votes">0</span>
</p>

<p>
Percentage:
<span id="percentage">0%</span>
</p>

<div class="progress-container">
    <div
        class="progress-bar"
        id="progressBar">
    </div>
</div>

</div>

<script src="js/app.js"></script>

<br>

<a href="logout.php">Logout</a>
<br><br>

<a href="results.php">
View Election Results

$setting =
$conn->query("SELECT election_open
FROM election_settings
WHERE id=1"
)->fetch_assoc();

if($setting['election_open']==0){

    echo "<h2>Election is currently closed.</h2>";
    exit();
}
</a>

</div>


</body>
</html>