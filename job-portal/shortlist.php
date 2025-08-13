<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
if (isset($_POST['shortlist_id'])) {
    $id = $_POST['shortlist_id'];
    $stmt = $conn->prepare("UPDATE applications SET status='shortlisted' WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}
$query = "SELECT applications.id, jobs.title, applicant_name, status FROM applications JOIN jobs ON applications.job_id = jobs.id WHERE status = 'pending'";
$result = $conn->query($query);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Shortlist Applicants</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Pending Applications</h2>
  <form method="POST" action="">
    <table border="1" cellpadding="10" style="margin: auto; background: white;">
      <tr><th>Job Title</th><th>Applicant Name</th><th>Action</th></tr>
      <?php while ($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['applicant_name']) ?></td>
        <td><button type="submit" name="shortlist_id" value="<?= $row['id'] ?>" class="btn">Shortlist</button></td>
      </tr>
      <?php endwhile; ?>
    </table>
  </form>
  <br>
  <a href="dashboard.php" class="btn">Back to Dashboard</a>
</body>
</html>