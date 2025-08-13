<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h1>Welcome, <?php echo $_SESSION['user']; ?>!</h1>
  <div class="dashboard">
    <a href="post_job.php" class="btn">Post a New Job</a>
    <a href="view_applications.php" class="btn">View Applications</a>
    <a href="shortlist.php" class="btn">Shortlist Applicants</a>
    <a href="logout.php" class="btn" style="background:red;">Logout</a>
  </div>
</body>
</html>