<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Job</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
      background-color: #f4f4f9;
    }

    h2 {
      color: #333;
    }

    form {
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      max-width: 600px;
    }

    label {
      font-weight: bold;
    }

    input[type="text"],
    input[type="date"],
    input[type="number"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <h2>Add New Job</h2>
  <form method="post" action="process_add_job.php">

    <label>Job Title:</label><br>
    <input type="text" name="title" required><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="40" required></textarea><br>

    <label>Requirements:</label><br>
    <textarea name="requirements" rows="4" cols="40" required></textarea><br>

    <label>Location:</label><br>
    <input type="text" name="location" required><br>

    <label>Region:</label><br>
    <input type="text" name="region" required><br>

    <label>Category:</label><br>
    <select name="category" required>
      <option value="">--Select Category--</option>
      <option value="Engineering">Engineering</option>
      <option value="Finance">Finance</option>
      <option value="IT">Information Technology</option>
      <option value="Marketing">Marketing</option>
      <option value="Administration">Administration</option>
    </select><br>

    <label>Salary Range:</label><br>
    <input type="text" name="salaryrange" placeholder="e.g. $1000 - $1500" required><br>

    <label>Posted Date:</label><br>
    <input type="date" name="posteddate" required><br>

    <label>Expiry Date:</label><br>
    <input type="date" name="expirydate" required><br>

    <label>More Information (optional):</label><br>
    <textarea name="moreinformation" rows="3" cols="40" placeholder="Additional details..."></textarea><br>

    <button type="submit">Add Job</button>
  </form>
</body>
</html>
