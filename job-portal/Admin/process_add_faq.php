<?php
session_start();
include '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question']);
    $answer = trim($_POST['answer']);

    if ($question !== "" && $answer !== "") {
        $stmt = $conn->prepare("INSERT INTO faq (question, answer) VALUES (?, ?)");
        $stmt->bind_param("ss", $question, $answer);

        if ($stmt->execute()) {
            echo "<p style='color:green;'>FAQ added successfully!</p>";
            echo "<a href='faqs.php'>Back to FAQs</a>";
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
