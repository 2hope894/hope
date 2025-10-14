<?php
include '../db.php'; // include your database connection

// Fetch all jobs from the database
$result = $conn->query("SELECT * FROM job ORDER BY posteddate DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Delete Job</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 30px;
    }
    h2 {
      color: #333;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      background: white;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
      vertical-align: top;
    }
    th {
      background: #007BFF;
      color: white;
    }
    tr:nth-child(even) {
      background: #f2f2f2;
    }
    a.delete-btn {
      color: red;
      text-decoration: none;
      font-weight: bold;
    }
    a.delete-btn:hover {
      text-decoration: underline;
    }
    .no-jobs {
      background: #fff3cd;
      padding: 15px;
      border: 1px solid #ffeeba;
      border-radius: 5px;
      color: #856404;
      margin-top: 20px;
    }
    .table-container {
      overflow-x: auto;
    }
  </style>
</head>
<body>

  <h2>Delete Job</h2>
  
  <?php if (isset($_GET['msg'])): ?>
  <p style="background:#d4edda; color:#155724; padding:10px; border-radius:5px;">
    <?php echo htmlspecialchars($_GET['msg']); ?>
  </p>
<?php endif; ?>

  <p>Below is a list of all posted jobs. Click <b>"Delete"</b> to remove a job.</p>

  <?php if ($result && $result->num_rows > 0): ?>
    <div class="table-container">
      <table>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Description</th>
          <th>Requirements</th>
          <th>Location</th>
          <th>Salary Range</th>
          <th>Posted Date</th>
          <th>Expiry Date</th>
          <th>More Information</th>
          <th>Region</th>
          <th>Category</th>
          <th>Action</th>
        </tr>

        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo htmlspecialchars($row['title']); ?></td>
          <td><?php echo nl2br(htmlspecialchars($row['description'])); ?></td>
          <td><?php echo nl2br(htmlspecialchars($row['requirements'])); ?></td>
          <td><?php echo htmlspecialchars($row['location']); ?></td>
          <td><?php echo htmlspecialchars($row['salaryrange']); ?></td>
          <td><?php echo htmlspecialchars($row['posteddate']); ?></td>
          <td><?php echo htmlspecialchars($row['expirydate']); ?></td>
          <td><?php echo nl2br(htmlspecialchars($row['moreinformation'])); ?></td>
          <td><?php echo htmlspecialchars($row['region']); ?></td>
          <td><?php echo htmlspecialchars($row['category']); ?></td>
          <td>
            <a class="delete-btn" href="process_delete_job.php?id=<?php echo $row['id']; ?>" 
               onclick="return confirm('Are you sure you want to delete this job?')">
              Delete
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </table>
    </div>
  <?php else: ?>
    <div class="no-jobs">
      <strong>No jobs found.</strong> It looks like no jobs have been posted yet.
    </div>
  <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
