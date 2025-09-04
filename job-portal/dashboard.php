<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$message = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');

    if ($title !== "" && $description !== "") {
        $stmt = $conn->prepare("INSERT INTO jobs (title, description) VALUES (?, ?)");
        if ($stmt) {
            $stmt->bind_param("ss", $title, $description);
            $stmt->execute();
            $stmt->close();
            $message = "Job posted successfully!";
        } else {
            $message = "Error posting job. Please try again.";
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
  <style>
    body { display: flex; min-height: 100vh; flex-direction: column; }
    .main-wrapper { display: flex; flex: 1; }
    .menu {
      width: 220px;
      background-color: rgba(0, 0, 0, 0.6);
      padding-top: 20px;
      display: flex;
      flex-direction: column;
    }
    .menu h2 { text-align: center; margin-bottom: 20px; font-size: 1.3rem; }
    .menu a {
      padding: 12px 20px;
      text-decoration: none;
      font-size: 1.1rem;
      color: white;
      display: block;
      transition: background 0.3s;
      cursor: pointer;
    }
    .menu a:hover { background-color: #575757; }
    .logout { background-color: red; margin-top: auto; }
    .logout:hover { background-color: darkred; }
    .content { flex: 1; padding: 20px; }
    .btn {
      background: #2575fc;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover { background: #1b5fc9; }
    input, textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
  </style>
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

<!-- Main Content -->
<div class="main-wrapper">
  <!-- Sidebar menu -->
  <div class="menu">
    <h2>Menu</h2>
    <a id="showWelcome">Dashboard</a>
    <a id="showPostJob">Post a New Job</a>
    <a href="view_applications.php">View Applications</a>
    <a href="shortlist.php">Shortlist Applicants</a>
    <a href="logout.php" class="logout">Logout</a>
  </div>

  <!-- Content area -->
  <div class="content" id="mainContent">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
    <?php if (!empty($message)) echo "<p style='color:lightgreen;'>".htmlspecialchars($message)."</p>"; ?>
    <p>Select an option from the menu on the left.</p>
  </div>
</div>

<!-- Footer -->
<?php include 'footer.php'; ?>

<script>
  const mainContent = document.getElementById("mainContent");

  document.getElementById("showWelcome").onclick = () => {
    mainContent.innerHTML = `
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
      <p>Select an option from the menu on the left.</p>
    `;
  };

  document.getElementById("showPostJob").onclick = () => {
    mainContent.innerHTML = `
      <h2>Post a New Job</h2>
      <form method="POST" action="">
        <input type="text" name="title" placeholder="Job Title" required>
        <textarea name="description" placeholder="Job Description" rows="5" required></textarea>
        <button type="submit" class="btn">Post Job</button>
      </form>
    `;
  };
</script>

</body>
</html>
