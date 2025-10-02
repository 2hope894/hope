<?php
include 'db.php';

$id = intval($_GET['id'] ?? 0);
$stmt = $conn->prepare("SELECT * FROM job WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$job = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo htmlspecialchars($job['Title']); ?> - Job Details</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f9f9f9; }
        .job-details { background: #fff; padding: 20px; border-radius: 6px; max-width: 800px; margin: auto; }
        h2 { color: #007BFF; }
        p { font-size: 15px; }
    </style>
</head>
<body>
    <div class="job-details">
        <h2><?php echo htmlspecialchars($job['Title']); ?></h2>
        <p><b>Region:</b> <?php echo htmlspecialchars($job['Region']); ?></p>
        <p><b>Category:</b> <?php echo htmlspecialchars($job['Category']); ?></p>
        <p><b>posted on:</b> <?php echo $job['postedDate']; ?></p>
        <hr>
        <p><?php echo nl2br(htmlspecialchars($job['Description'])); ?></p>
    </div>
</body>
</html>
