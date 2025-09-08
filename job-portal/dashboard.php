<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Job Portal</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    


  </style>
</head>
<body>
  <!-- Header -->
  <?php include 'header.php'; ?>

  

  

  <!-- Footer -->
  <?php include 'footer.php'; ?>
</body>
</html>
