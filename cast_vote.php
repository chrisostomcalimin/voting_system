<?php

session_start();
include "config/db.php";

if(!isset($_SESSION['student_id'])){
    header("Location: login.php");
    exit();
}

$studentId = $_SESSION['student_id'];

$candidateId = $_POST['candidate_id'];

$student = $conn->query(
    "SELECT * FROM students
     WHERE id=$studentId"
)->fetch_assoc();

if($student['has_voted'] == 1){

    die("You have already voted.");
}

$conn->query(
"INSERT INTO votes
(student_id,candidate_id)
VALUES
($studentId,$candidateId)"
);

$conn->query(
"UPDATE students
SET has_voted=1
WHERE id=$studentId"
);

header("Location: vote.php");
exit();

?>