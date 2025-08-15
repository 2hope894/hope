<?php
session_start();
include 'db.php';

// Redirect if not logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $stmt = $conn->prepare("INSERT INTO jobs (title, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $description);
    $stmt->execute();
    $message = "Job posted successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(135deg, #6a11cb, #2575fc);
      color: white;
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar menu */
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

    /* Content area */
    .content { flex: 1; padding: 20px; }
    .content h1 { margin-bottom: 20px; }
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

<!-- Sidebar menu -->
<div class="menu">
  <h2>Menu</h2>
  <a id="showWelcome">Dashboard</a>
  <a id="showPostJob">Post a New Job</a>
  <a href="view_applications.php">View Applications</a>
  <a href="shortlist.php">Shortlist Applicants</a>
  <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Main content -->
<div class="content" id="mainContent">
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
  <?php if (isset($message)) echo "<p style='color:lightgreen;'>$message</p>"; ?>
  <p>Select an option from the menu on the left.</p>
</div>

<script>
  const mainContent = document.getElementById("mainContent");

  // Show welcome message
  document.getElementById("showWelcome").onclick = () => {
    mainContent.innerHTML = `
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
      <p>Select an option from the menu on the left.</p>
    `;
  };

  // Show post job form
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
