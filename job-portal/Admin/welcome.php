<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Welcome - Admin Dashboard</title>
</head>
<body>
  <h1>Welcome to the Admin Dashboard</h1>
  <p>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?>. Use the sidebar to manage jobs, applications, news, and FAQs.</p>
</body>
</html>
