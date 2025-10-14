<?php
include 'db.php'; // database connection

// Fetch all FAQs
$result = $conn->query("SELECT * FROM faq ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>FAQs - Job Portal</title>
    <link rel="stylesheet" href="css/portal.css">
    <style>
        h2 {
            color: white;
            margin-top: 100px;
            margin-bottom: 20px;
            text-align: center;
        }
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }
        .faq-item {
            background: #636ccb;
            padding: 15px 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .faq-question {
            font-size: 18px;
            font-weight: bold;
            color: white;
            margin-bottom: 8px;
        }
        .faq-answer {
            font-size: 16px;
            color: white;
        }
    </style>
</head>
<body>
<!-- Header -->
<?php include 'header.php'; ?>

<main class="faq-container">
    <h2>Frequently Asked Questions</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="faq-item">
                <div class="faq-question"><?php echo htmlspecialchars($row['question']); ?></div>
                <div class="faq-answer"><?php echo nl2br(htmlspecialchars($row['answer'])); ?></div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No FAQs available at the moment.</p>
    <?php endif; ?>
</main>

<!-- Mission -->
<h2 class="mission-title">Our Mission</h2>
<p class="mission-text">
  At JobPortal, we aim to help people get jobs and help employers connect with the right people.
</p>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
