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

    /* Modal styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      left: 0; top: 0;
      width: 100%; height: 100%;
      background-color: rgba(0,0,0,0.5);
    }
    .modal-content {
      background-color: white;
      color: black;
      margin: 10% auto;
      padding: 20px;
      border-radius: 8px;
      width: 400px;
    }
    .close {
      float: right;
      font-size: 20px;
      cursor: pointer;
    }
    .btn {
      background: #2575fc;
      color: white;
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .btn:hover { background: #1b5fc9; }
  </style>
</head>
<body>

<!-- Sidebar menu -->
<div class="menu">
  <h2>Menu</h2>
  <a id="openModal">Post a New Job</a>
  <a href="view_applications.php">View Applications</a>
  <a href="shortlist.php">Shortlist Applicants</a>
  <a href="logout.php" class="logout">Logout</a>
</div>

<!-- Main content -->
<div class="content">
  <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
  <?php if (isset($message)) echo "<p style='color:lightgreen;'>$message</p>"; ?>
  <p>Select an option from the menu on the left.</p>
</div>

<!-- Modal for Posting Job -->
<div id="jobModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Post a New Job</h2>
    <form method="POST" action="">
      <input type="text" name="title" placeholder="Job Title" required style="width:100%;padding:8px;"><br><br>
      <textarea name="description" placeholder="Job Description" rows="5" required style="width:100%;padding:8px;"></textarea><br><br>
      <button type="submit" class="btn">Post Job</button>
    </form>
  </div>
</div>

<script>
  // Get modal elements
  const modal = document.getElementById("jobModal");
  const openBtn = document.getElementById("openModal");
  const closeBtn = document.querySelector(".close");

  // Open modal
  openBtn.onclick = () => { modal.style.display = "block"; };
  // Close modal
  closeBtn.onclick = () => { modal.style.display = "none"; };
  // Close if click outside
  window.onclick = (event) => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
</script>

</body>
</html>
