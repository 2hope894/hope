<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$query = "SELECT applications.id, jobs.title, applicant_name, status FROM applications JOIN jobs ON applications.job_id = jobs.id";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Applications</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>All Applications</h2>
  <table border="1" cellpadding="10" style="margin: auto; background: white;">
    <tr><th>Job Title</th><th>Applicant Name</th><th>Status</th></tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['title']) ?></td>
      <td><?= htmlspecialchars($row['applicant_name']) ?></td>
      <td><?= htmlspecialchars($row['status']) ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <br>
  <a href="dashboard.php" class="btn">Back to Dashboard</a>
</body>
</html>