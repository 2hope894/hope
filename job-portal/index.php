<?php
session_start();
mysqli_report(MYSQLI_REPORT_OFF);
@include_once 'db.php';

// Prepare containers
$jobs = [];
$news = [];

// Fetch jobs
if (isset($conn) && $conn instanceof mysqli && $conn->connect_errno === 0) {
    $jobSql = "SELECT title, company FROM jobs ORDER BY created_at DESC LIMIT 5";
    if ($jobQuery = @$conn->query($jobSql)) {
        while ($row = $jobQuery->fetch_assoc()) {
            $jobs[] = $row;
        }
        $jobQuery->free();
    }

    // Fetch news
    $newsSql = "SELECT headline FROM news ORDER BY created_at DESC LIMIT 3";
    if ($newsQuery = @$conn->query($newsSql)) {
        while ($row = $newsQuery->fetch_assoc()) {
            $news[] = $row['headline'] ?? '';
        }
        $newsQuery->free();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Portal</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

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
          <?= htmlspecialchars($job['title'] ?? 'Untitled') ?> – <?= htmlspecialchars($job['company'] ?? 'Unknown Company') ?>
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
        <?php if (trim((string)$item) !== ''): ?>
          <div class="news-item"><?= htmlspecialchars($item) ?></div>
        <?php endif; ?>
      <?php endforeach; ?>
      <?php if (empty(array_filter($news, fn($x) => trim((string)$x) !== ''))): ?>
        <p>No news right now.</p>
      <?php endif; ?>
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
<?php include 'footer.php'; ?>

</body>
</html>
