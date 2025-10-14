<?php
include 'db.php';

// Fetch filter values
$regions = $conn->query("SELECT DISTINCT Region FROM job ORDER BY Region");
$categories = $conn->query("SELECT DISTINCT Category FROM job ORDER BY Category");

// Build query with filters
$conditions = [];
$params = [];
if (!empty($_GET['region'])) {
    $conditions[] = "Region = ?";
    $params[] = $_GET['region'];
}
if (!empty($_GET['category'])) {
    $conditions[] = "Category = ?";
    $params[] = $_GET['category'];
}
$where = $conditions ? "WHERE " . implode(" AND ", $conditions) : "";

$sql = "SELECT id, title, Region, Category, postedDate, LEFT(Description, 200) AS Snippet 
        FROM job $where ORDER BY postedDate DESC";
$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param(str_repeat("s", count($params)), ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Job Vacancies</title>
    <link rel="stylesheet" href="css/portal.css">
    <style>
        
        
    
        
        .container { width: 90%;
             max-width: 1200px;
              margin: 20px auto;
             margin-top: 100px;}

        .filters { background: #636ccb;
             padding: 15px;
              border-radius: 6px;
               margin-bottom: 20px; }

        
        .job-listing { background: #fff;
             padding: 15px; 
             border-radius: 6px; 
             margin-bottom: 15px;
              box-shadow: 0 2px 5px rgba(0,0,0,0.1); }

        .job-title { font-size: 18px; 
            font-weight: bold;
             color: #007BFF; margin: 0; }

        .job-meta { font-size: 14px;
             color: #666; 
             margin: 5px 0; }

        .job-desc { font-size: 15px;
             color: #333; }
        
    </style>
</head>
<body>
    
  <!-- Header -->
  <?php include 'header.php'; ?>
 

    <div class="container">
        <!-- Filters -->
        <div class="filters">
            <form method="get">
                <select name="region">
                    <option value="">All Regions</option>
                    <?php while ($r = $regions->fetch_assoc()) { ?>
                        <option value="<?php echo $r['Region']; ?>" 
                            <?php if ($_GET['region'] == $r['Region']) echo "selected"; ?>>
                            <?php echo htmlspecialchars($r['Region']); ?>
                        </option>
                    <?php } ?>
                </select>
                <select name="category">
                    <option value="">All Categories</option>
                    <?php while ($c = $categories->fetch_assoc()) { ?>
                        <option value="<?php echo $c['Category']; ?>" 
                            <?php if ($_GET['category'] == $c['Category']) echo "selected"; ?>>
                            <?php echo htmlspecialchars($c['Category']); ?>
                        </option>
                    <?php } ?>
                </select>
                <button type="submit">Filter</button>
            </form>
        </div>

        <!-- Jobs -->
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($job = $result->fetch_assoc()) { ?>
                <div class="job-listing">
                    <p class="job-title">
                        <a href="job_detail.php?id=<?php echo $job['JobID']; ?>">
                            <?php echo htmlspecialchars($job['Title']); ?>
                        </a>
                    </p>
                    <p class="job-meta">
                        <?php echo htmlspecialchars($job['Company']); ?> |
                        <?php echo htmlspecialchars($job['Region']); ?> |
                        <?php echo htmlspecialchars($job['Category']); ?> |
                        posted: <?php echo $job['postedDate']; ?>
                    </p>
                    <p class="job-desc"><?php echo nl2br(htmlspecialchars($job['Snippet'])); ?>...</p>
                </div>
            <?php } ?>
        <?php } else { ?>
            <p>No jobs found.</p>
        <?php } ?>
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
