<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $stmt = $conn->prepare("INSERT INTO jobs (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    $message = "Job posted successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Post a Job</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Post a New Job</h2>
  <?php if (isset($message)) echo "<p style='color:green;'>$message</p>"; ?>
  <form method="POST" action="">
    <input type="text" name="title" placeholder="Job Title" required><br><br>
    <textarea name="description" placeholder="Job Description" rows="5" required></textarea><br><br>
    <button type="submit" class="btn">Post Job</button>
  </form>
  <br>
  <a href="dashboard.php" class="btn">Back to Dashboard</a>
</body>
</html>