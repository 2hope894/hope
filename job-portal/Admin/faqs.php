<?php
session_start();
include '../db.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>FAQs Management</title>
</head>
<body>
  <h2>Manage FAQs</h2>
  <form method="post" action="process_add_faq.php">
    <label>Question:</label><br>
    <input type="text" name="question" required><br><br>

    <label>Answer:</label><br>
    <textarea name="answer" rows="4" cols="40" required></textarea><br><br>

    <button type="submit">Add FAQ</button>
  </form>

  <h3>Existing FAQs</h3>
  <table border="1" cellpadding="5">
    <tr>
      <th>ID</th>
      <th>Question</th>
      <th>Answer</th>
      <th>Action</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM faq ORDER BY id DESC");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>".htmlspecialchars($row['question'])."</td>
                    <td>".htmlspecialchars($row['answer'])."</td>
                    <td>
                      <a href='process_delete_faq.php?id={$row['id']}' onclick='return confirm(\"Delete this FAQ?\")'>Delete</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No FAQs found.</td></tr>";
    }
    ?>
  </table>
</body>
</html>
