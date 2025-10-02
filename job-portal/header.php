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
    <a href="job_vacancies.php">Job Vacancies</a>

   <?php if (isset($_SESSION['user_name'])): ?>
  <a href="my_account.php">My account</a>
<?php endif; ?>

  
    <a href="news.php">News</a>
    <a href="faqs.php">FAQs</a>
  </nav>

<?php if (!isset($_SESSION['user_name'])): ?>
  <a href="auth.php" class="btn-top">Login / Register</a>
<?php else: ?>
  <a href="logout.php" class="btn-top">Logout</a>
<?php endif; ?>

</header>
