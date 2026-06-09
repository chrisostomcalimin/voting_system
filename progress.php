<?php

include "config/db.php";

$totalStudents = $conn->query(
    "SELECT COUNT(*) AS total FROM students"
)->fetch_assoc()['total'];

$totalVotes = $conn->query(
    "SELECT COUNT(*) AS total FROM votes"
)->fetch_assoc()['total'];

$percentage = 0;

if($totalStudents > 0){
    $percentage = round(
        ($totalVotes / $totalStudents) * 100,
        2
    );
}

echo json_encode([
    "students" => $totalStudents,
    "votes" => $totalVotes,
    "percentage" => $percentage
]);