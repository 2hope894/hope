<?php
session_start();
include '../db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>News Management</title>
</head>
<body>
  <h2>Manage News</h2>
  <form method="post" action="process_add_news.php">
    <label>Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Content:</label><br>
    <textarea name="content" rows="5" cols="40" required></textarea><br><br>

    <button type="submit">Publish News</button>
  </form>

  <h3>Existing News</h3>
  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Content</th>
      <th>Date</th>
      <th>Action</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM news ORDER BY created_at DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>".htmlspecialchars($row['title'])."</td>
                    <td>".htmlspecialchars($row['content'])."</td>
                    <td>{$row['created_at']}</td>
                    <td>
                      <a href='process_delete_news.php?id={$row['id']}' onclick='return confirm(\"Delete this news?\")'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No news found.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
