<?php
include 'db_connect.php'; // Your database connection file

header('Content-Type: application/json');

$sql = "SELECT title, description, requirements, location, salaryrange, posteddate, expirydate, moreinformation, region, category FROM job ORDER BY posteddate DESC";
$result = $conn->query($sql);

$jobs = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $jobs[] = $row;
    }
}

echo json_encode($jobs);
?>
