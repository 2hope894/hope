<?php
session_start();
include 'db.php';

// Fetch top jobs
$jobs = [];
$jobQuery = $conn->query("SELECT title, company FROM jobs ORDER BY created_at DESC LIMIT 5");
if ($jobQuery && $jobQuery->num_rows > 0) {
    while ($row = $jobQuery->fetch_assoc()) {
        $jobs[] = $row;
    }
}

// Fetch news
$news = [];
$newsQuery = $conn->query("SELECT headline FROM news ORDER BY created_at DESC LIMIT 3");
if ($newsQuery && $newsQuery->num_rows > 0) {
    while ($row = $newsQuery->fetch_assoc()) {
        $news[] = $row['headline'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal</title>
  <style>
   body {
      font-family: Arial, sans-serif;
      margin: 0; 
      padding: 0;
      background-image: url("css/background.jpg"); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: white;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 25px;
      background: rgba(0,0,0,0.6);
      position: fixed;
      top: 0; left: 0;
      width: 100%;
      z-index: 10;
      flex-wrap: wrap;
    }

    .label-logo {
      font-size: 28px;
      font-weight: bold;
      font-family: 'Segoe UI', Arial, sans-serif;
      text-decoration: none;
      color: #1e90ff;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
      transition: transform 0.3s, color 0.3s;
    }
    .label-logo span { color: #ff6600; }
    .label-logo:hover {
      transform: scale(1.05);
      color: #00bfff;
    }

    nav {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }
    nav a {
      color: #fff;
      text-decoration: none;
      font-size: 16px;
      font-weight: 500;
      transition: color 0.3s, border-bottom 0.3s;
      padding-bottom: 4px;
    }
    nav a:hover {
      color: #1e90ff;
      border-bottom: 2px solid #1e90ff;
    }

    .btn-top {
      padding: 10px 20px;
      background-color: rgba(19,114,215,0.9);
      color: white;
      margin-right: 40px;
      font-size: 16px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s;
    }
    .btn-top:hover { background-color: rgba(0,86,179,0.9); }

    .container {
      flex: 1;
      padding-top: 100px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    h1 {
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgb(0,0,0);
      font-size: 2.5rem;
    }

    .search-section {
      margin: 20px auto;
      background: rgba(0,0,0,0.7);
      padding: 20px;
      border-radius: 10px;
      max-width: 700px;
      width: 90%;
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
    }
    .search-section input, .search-section select {
      padding: 10px;
      margin: 5px;
      border-radius: 5px;
      border: none;
      width: 30%;
      min-width: 120px;
    }
    .search-section button {
      padding: 10px 20px;
      border-radius: 5px;
      border: none;
      background: #007bff;
      color: white;
      cursor: pointer;
    }
    .search-section button:hover { background: #0056b3; }

    .jobs-section, .news-section {
      background: rgba(0,0,0,0.7);
      padding: 20px;
      margin: 20px auto;
      border-radius: 10px;
      max-width: 700px;
      width: 90%;
      text-align: left;
    }
    .jobs-section h2, .news-section h2 { margin-bottom: 10px; }
    .job-item, .news-item { margin-bottom: 10px; }

    .mission-title {
      font-size: 36px;
      margin: 20px auto;
      background: rgba(0,0,0,0.6);
      color: white;
      padding: 10px;
      border-radius: 6px;
      box-shadow: 2px 2px 8px rgba(0,0,0,0.7);
      text-align: center;
      max-width: 700px;
    }

    .mission-text {
      background: rgba(255,255,255,0.85);
      color: black;
      padding: 12px;
      border-radius: 6px;
      box-shadow: 2px 2px 8px rgba(0,0,0,0.5);
      text-align: center;
      max-width: 700px;
      margin: 10px auto 30px auto;
    }

    footer {
      background-color: rgba(0,0,0,0.7);
      color: white;
      padding: 20px 40px 10px 40px;
      font-size: 14px;
    }

    .footer-top {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
      gap: 20px;
    }

    .footer-logo {
      text-align: right;
      flex: 1;
    }

    .company-info {
      text-align: left;
      flex: 1;
    }

    .company-info h4 { margin-bottom: 8px; }

    .company-info a {
      display: block;
      color: #fff;
      text-decoration: none;
      margin-bottom: 6px;
      transition: color 0.2s ease;
    }
    .company-info a:hover { color: #ccc; }

    .social-section {
      text-align: center;
      margin-top: 20px;
    }
    .social-section h3 { margin-bottom: 10px; }
    .social-icons {
      display: flex;
      justify-content: center;
      gap: 15px;
      background-color: #0056b3;
      padding: 10px;
      border-radius: 8px;
      flex-wrap: wrap;
    }
    .social-icons a img {
      width: 40px;
      height: 40px;
      transition: transform 0.3s;
    }
    .social-icons a img:hover { transform: scale(1.2); }

    .footer-bottom {
      text-align: center;
      margin-top: 15px;
      font-size: 13px;
    }

    /* Responsive Adjustments */
    @media (max-width: 1024px) {
      .search-section input, .search-section select { width: 45%; }
    }

    @media (max-width: 768px) {
      header { flex-direction: column; align-items: flex-start; }
      nav { margin-top: 10px; gap: 15px; }
      .btn-top {
        margin: 10px 0 0 0;
        width: 100%;
        text-align: center;
      }
      h1 { font-size: 2rem; }
    }

    @media (max-width: 600px) {
      .search-section { flex-direction: column; align-items: stretch; }
      .search-section input, .search-section select, .search-section button { width: 100%; }
      .footer-top { flex-direction: column; text-align: center; }
      .footer-logo, .company-info { text-align: center; }
      .social-icons a img { width: 32px; height: 32px; }
      h1 { font-size: 1.8rem; }
    }
  </style>
</head>
<body>

<!-- Header -->
<header>
  <div>
    <a href="index.php" class="label-logo">Job<span>Portal</span></a>
  </div>

  <nav>
    <a href="index.php">Job Seeker Home </a>
    <a href="terms_conditions.php">Job Vacancies</a>
    <a href="about.php">My Account</a>
    <a href="about.php">News</a>
    <a href="about.php">FAQs</a>
  </nav>

  <div>
      <a href="auth.php" class="btn-top">Login / Register</a>
  </div>
</header>

<!-- Home Section -->
<div class="container">
  <h1>Find Your Next Job</h1>

  <!-- Search -->
  <div class="search-section">
    <form action="search.php" method="get">
      <input type="text" name="keyword" placeholder="Keyword">
      <input type="text" name="location" placeholder="Location">
      <select name="vacancy_type">
        <option value="">All Types</option>
        <option value="Paid">Paid Position</option>
        <option value="Apprenticeship">Apprenticeship</option>
        <option value="WorkPlacement">Work Placement</option>
      </select>
      <button type="submit">Search</button>
    </form>
  </div>

  <!-- Featured Jobs -->
  <div class="jobs-section">
    <h2>Top Jobs Today</h2>
    <?php if(!empty($jobs)): ?>
      <?php foreach($jobs as $job): ?>
        <div class="job-item">
          <?= htmlspecialchars($job['title']) ?> – <?= htmlspecialchars($job['company']) ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No jobs available at the moment.</p>
    <?php endif; ?>
  </div>

  <!-- News -->
  <div class="news-section">
    <h2>What’s Going On?</h2>
    <?php if(!empty($news)): ?>
      <?php foreach($news as $item): ?>
        <div class="news-item"><?= htmlspecialchars($item) ?></div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No news right now.</p>
    <?php endif; ?>
  </div>
</div>

<!-- Mission -->
<h2 class="mission-title">Our Mission</h2>
<p class="mission-text">
  At JobPortal, we aim to help people get jobs and help employers connect with the right people.
</p>

<!-- Footer -->
<footer>
  <div class="footer-top">
    <div class="company-info">
      <h4>Company Info</h4>
      <a href="about.php">About Us</a>
      <a href="terms_conditions.php">Terms & Conditions</a>
      <a href="contact_us.php">Contact Us</a>
    </div>

    <div class="footer-logo">
      <a href="index.php" class="label-logo">Job<span>Portal</span></a>
    </div>
  </div>

  <!-- Social Media Section -->
  <div class="social-section">
    <h3>Follow Us</h3>
    <div class="social-icons">
      <a href="#" target="_blank"><img src="css/facebook.png" alt="Facebook"></a>
      <a href="#" target="_blank"><img src="css/google.png" alt="Google"></a>
      <a href="#" target="_blank"><img src="css/instagram.png" alt="Instagram"></a>
      <a href="#" target="_blank"><img src="css/telegram.png" alt="Telegram"></a>
      <a href="#" target="_blank"><img src="css/whatsapp.png" alt="WhatsApp"></a>
    </div>
  </div>

  <!-- Copyright -->
  <div class="footer-bottom">
    <p>&copy; 2025 Job Portal. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
