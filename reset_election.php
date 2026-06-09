<?php
session_start();
include "config/db.php";

if(!isset($_SESSION['admin_id'])){
    exit();
}

$conn->query(
"DELETE FROM votes"
);

$conn->query(
"UPDATE students
SET has_voted=0"
);

echo "
<h2>
Election Reset Successful
</h2>

<a href='admin_dashboard.php'>
Back
</a>
";
?>