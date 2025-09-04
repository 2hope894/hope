<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
  <div>
    <a href="index.php" class="label-logo">Job<span>Portal</span></a>
  </div>

  <nav>
    <a href="index.php">Job Seeker Home</a>
    <a href="#">Job Vacancies</a>
    <?php if (isset($_SESSION['user'])): ?>
      <a href="dashboard.php">Dashboard</a>
    <?php endif; ?>
    <a href="#">News</a>
    <a href="#">FAQs</a>
  </nav>

  <div>
    <?php if (!isset($_SESSION['user'])): ?>
      <a href="auth.php" class="btn-top">Login / Register</a>
    <?php else: ?>
      <a href="logout.php" class="btn-top">Logout</a>
    <?php endif; ?>
  </div>
</header>
