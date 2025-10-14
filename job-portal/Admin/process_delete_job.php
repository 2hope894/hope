<?php
include '../db.php'; // adjust the path if needed

// Check if an ID was passed in the URL
if (isset($_GET['id'])) {
    $job_id = intval($_GET['id']); // ensure it's an integer

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM job WHERE id = ?");
    $stmt->bind_param("i", $job_id);

    if ($stmt->execute()) {
        // Redirect back with success message
        header("Location: delete_job.php?msg=Job+deleted+successfully");
        exit();
    } else {
        // Redirect back with error message
        header("Location: delete_job.php?msg=Error+deleting+job");
        exit();
    }

    $stmt->close();
} else {
    // No ID provided
    header("Location: delete_job.php?msg=No+job+ID+provided");
    exit();
}

$conn->close();
?>
