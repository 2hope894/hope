<?php
session_start();
include '../db.php'; // adjust path if needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $deadline = $_POST['deadline'];

    if ($title !== "" && $description !== "" && $location !== "" && $deadline !== "") {
        $stmt = $conn->prepare("INSERT INTO jobs (title, description, location, deadline) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $title, $description, $location, $deadline);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>Job added successfully!</p>";
            echo "<a href='add_job.php'>Back to Add Job</a>";
        } else {
            echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p style='color:red;'>All fields are required.</p>";
    }
}
$conn->close();
?>
