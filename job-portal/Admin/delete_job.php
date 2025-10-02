<!DOCTYPE html>
<html>
<head>
  <title>Delete Job</title>
</head>
<body>
  <h2>Delete Job</h2>
  <p>Here you can display jobs and delete them.</p>
  <!-- Example placeholder -->
  <table border="1" cellpadding="5">
    <tr><th>Job ID</th><th>Title</th><th>Action</th></tr>
    <tr>
      <td>1</td>
      <td>Software Engineer</td>
      <td><a href="process_delete_job.php?id=1" onclick="return confirm('Delete this job?')">Delete</a></td>
    </tr>
  </table>
</body>
</html>
