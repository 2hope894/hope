<?php
session_start();
include '../db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("DELETE FROM faqs WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>FAQ deleted successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
$conn->close();

echo "<a href='faqs.php'>Back to FAQs</a>";
?>
