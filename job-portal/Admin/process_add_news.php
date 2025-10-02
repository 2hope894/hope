<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    if ($title !== "" && $content !== "") {
        $stmt = $conn->prepare("INSERT INTO news (title, content, created_at) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $title, $content);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>News published successfully!</p>";
            echo "<a href='news.php'>Back to News</a>";
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
