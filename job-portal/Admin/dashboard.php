<?php
session_start();

// only admins allowed
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth.php"); // go back to login if not admin
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard - Job Portal</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      display: flex;
      height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 220px;
      background-color: #2c3e50;
      color: white;
      padding-top: 20px;
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .sidebar a {
      padding: 12px;
      text-decoration: none;
      color: white;
      display: block;
      transition: background 0.3s;
    }

    .sidebar a:hover {
      background-color: #34495e;
    }

    /* Main content */
    .main-content {
      flex: 1;
      padding: 20px;
      background: #f4f6f9;
      overflow-y: auto;
    }

    .logout {
      margin-top: auto;
      padding: 12px;
      background-color: #c0392b;
      text-align: center;
    }

    .logout a {
      color: white;
      text-decoration: none;
    }

    iframe {
      width: 100%;
      height: calc(100vh - 60px);
      border: none;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin Panel</h2>
    <p style="text-align:center;">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> (Admin)</p>
    
    <!-- Sidebar links -->
    <a href="add_job.php" target="contentFrame">Add Job</a>
    <a href="edit_job.php" target="contentFrame">Edit Job</a>
    <a href="delete_job.php" target="contentFrame">Delete Job</a>
    <a href="shortlist.php" target="contentFrame">Shortlist</a>
    <a href="view_applications.php" target="contentFrame">View Applications</a>
    <a href="news.php" target="contentFrame">News</a>
    <a href="faqs.php" target="contentFrame">FAQs</a>
    
    <div class="logout">
      <a href="../logout.php">Logout</a>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <iframe name="contentFrame" src="welcome.php"></iframe>
  </div>
</body>
</html>
