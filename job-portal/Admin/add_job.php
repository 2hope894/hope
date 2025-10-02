<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Job</title>
</head>
<body>
  <h2>Add New Job</h2>
  <form method="post" action="process_add_job.php">
    <label>Job Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="5" cols="40" required></textarea><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" required><br><br>

    <label>Deadline:</label><br>
    <input type="date" name="deadline" required><br><br>

    <button type="submit">Add Job</button>
  </form>
</body>
</html>
