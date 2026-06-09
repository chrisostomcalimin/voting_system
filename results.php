<?php
include "config/db.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Election Results</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">

<h2>Election Results</h2>

<table border="1" width="100%" cellpadding="10">

<tr>
    <th>Candidate</th>
    <th>Position</th>
    <th>Total Votes</th>
</tr>

<?php

$sql = "
SELECT
    candidates.name,
    candidates.position,
    COUNT(votes.id) AS total_votes

FROM candidates

LEFT JOIN votes
ON candidates.id = votes.candidate_id

GROUP BY candidates.id

ORDER BY total_votes DESC
";

$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

<tr>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['position']; ?>
</td>

<td>
<?php echo $row['total_votes']; ?>
</td>

</tr>

<?php
}
?>

</table>

</div>

</body>
</html>