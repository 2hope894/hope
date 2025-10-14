<?php
include 'db.php'; // connection file

// Fetch all news
$result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Latest News</title>

    <link rel="stylesheet" href="css/portal.css">

    <style>
        h2 { 
            color: white;
            margin-top: 100px;
            margin-bottom: 20px; 
            text-align: center;
        }

        .news-item { 
            background: #636ccb;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .news-title { 
            font-size: 20px;
            font-weight: bold;
            color: white;
            margin-bottom: 8px; 
        }

        .news-date { 
            font-size: 14px;
            color: white;
            margin-bottom: 10px; 
        }

        .news-content { 
            font-size: 16px;
            color: white; 
        }
    </style>
</head>
<body>
<!-- Header -->
<?php include 'header.php'; ?>

    <h2>Latest News</h2>

    <?php if ($result && $result->num_rows > 0) { ?>
        <?php while($row = $result->fetch_assoc()) { ?>
            <div class="news-item">
                <div class="news-title"><?php echo htmlspecialchars($row['title']); ?></div>
                <div class="news-date">Published on: 
                    <?php echo date("F j, Y, g:i a", strtotime($row['created_at'])); ?>
                </div>
                <div class="news-content"><?php echo nl2br(htmlspecialchars($row['content'])); ?></div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No news available.</p>
    <?php } ?>

<!-- Mission -->
<h2 class="mission-title">Our Mission</h2>
<p class="mission-text">
  At JobPortal, we aim to help people get jobs and help employers connect with the right people.
</p>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
