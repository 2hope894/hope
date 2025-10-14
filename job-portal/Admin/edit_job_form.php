<?php
include '../db.php'; // adjust the path if needed

// Check if job ID is provided
if (!isset($_GET['id'])) {
    header("Location: edit_job.php?msg=No+job+selected");
    exit();
}

$id = intval($_GET['id']);

// Fetch the job details
$stmt = $conn->prepare("SELECT * FROM job WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: edit_job.php?msg=Job+not+found");
    exit();
}

$job = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get updated values from the form
    $title = $_POST['title'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $location = $_POST['location'];
    $salaryrange = $_POST['salaryrange'];
    $posteddate = $_POST['posteddate'];
    $expirydate = $_POST['expirydate'];
    $moreinformation = $_POST['moreinformation'];
    $region = $_POST['region'];
    $category = $_POST['category'];

    // Update query
    $update = $conn->prepare("UPDATE job SET 
        title = ?, 
        description = ?, 
        requirements = ?, 
        location = ?, 
        salaryrange = ?, 
        posteddate = ?, 
        expirydate = ?, 
        moreinformation = ?, 
        region = ?, 
        category = ? 
        WHERE id = ?");
    $update->bind_param("ssssssssssi", 
        $title, 
        $description, 
        $requirements, 
        $location, 
        $salaryrange, 
        $posteddate, 
        $expirydate, 
        $moreinformation, 
        $region, 
        $category, 
        $id
    );

    if ($update->execute()) {
        header("Location: edit_job.php?msg=Job+updated+successfully");
        exit();
    } else {
        echo "<p style='color:red;'>Error updating job: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Job</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 30px;
    }
    form {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 800px;
      margin: auto;
    }
    h2 {
      text-align: center;
      color: #333;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="date"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-family: Arial, sans-serif;
    }
    textarea {
      height: 100px;
      resize: vertical;
    }
    input[type="submit"] {
      background: #007BFF;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      margin-top: 15px;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background: #0056b3;
    }
    a.back {
      display: inline-block;
      margin-top: 15px;
      color: #007BFF;
      text-decoration: none;
    }
    a.back:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <h2>Edit Job</h2>

  <form method="post">
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo htmlspecialchars($job['title']); ?>" required>

    <label>Description
