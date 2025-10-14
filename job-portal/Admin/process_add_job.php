<?php
session_start();
include 'db.php'; // Make sure this file contains your database connection ($conn)

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data safely
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $region = mysqli_real_escape_string($conn, $_POST['region']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $salaryrange = mysqli_real_escape_string($conn, $_POST['salaryrange']);
    $posteddate = mysqli_real_escape_string($conn, $_POST['posteddate']);
    $expirydate = mysqli_real_escape_string($conn, $_POST['expirydate']);
    $moreinformation = mysqli_real_escape_string($conn, $_POST['moreinformation']);

    // Prepare SQL statement
    $sql = "INSERT INTO job (title, description, requirements, location, region, category, salaryrange, posteddate, expirydate, moreinformation)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssssss", $title, $description, $requirements, $location, $region, $category, $salaryrange, $posteddate, $expirydate, $moreinformation);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Job added successfully!');
                    window.location.href='view_jobs.php'; // redirect to job listing page
                  </script>";
        } else {
            echo "<script>
                    alert('Error adding job. Please try again.');
                    window.history.back();
                  </script>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "<script>alert('Database error: Unable to prepare statement.');</script>";
    }

    mysqli_close($conn);

} else {
    echo "<script>alert('Invalid request.');</script>";
}
?>
