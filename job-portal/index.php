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

  <style>

    /* Container Sections */
.container {
  padding: 100px 40px 40px; /* top padding avoids overlap with fixed header */
  max-width: 1600px;
  width: 100%;
  background: rgba(0,0,0,0.6);
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  text-align: center;
  margin-top: 80px; /* ensure spacing from header */
  margin-bottom: 80px;
}

/* Title */
.container h1 {
  margin-bottom: 20px;
}

/* Search Section */
.search-section {
  background: rgba(0, 0, 0, 0.94);
  padding: 20px;
  border-radius: 12px;
  margin-bottom: 30px;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 10px;
}

.search-section input,
.search-section select {
  padding: 10px;
  border: none;
  border-radius: 6px;
  min-width: 180px;
}

.search-section button {
  padding: 10px 20px;
  border: none;
  border-radius: 6px;
  background: #ff6600;
  color: #000;
  font-weight: bold;
  cursor: pointer;
  transition: background 0.3s;
}

.search-section button:hover {
  background: #853804;
}

/* Jobs & News Sections */
.jobs-section,
.news-section {
  margin-bottom: 30px;
}

.job-item,
.news-item {
  background: rgba(0, 0, 0, 0.5);
  padding: 12px;
  border-radius: 8px;
  margin: 8px 0;
  color: #fff;
  
}


  </style>

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
    <?php
    include 'db.php';

    // Fetch news from DB
    $sql = "SELECT title, content, created_at FROM news ORDER BY created_at DESC";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
            // Combine title + content nicely
            $item = "<strong>" . htmlspecialchars($row['title']) . "</strong><br>" .
                    "<small>" . date("F j, Y, g:i a", strtotime($row['created_at'])) . "</small><br>" .
                    nl2br(htmlspecialchars($row['content']));
            ?>
            <div class="news-item"><?= $item ?></div>
        <?php endwhile; ?>
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
