<?php
include '../db.php'; // adjust this path to your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST values
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        echo "Missing parameters";
        exit;
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "Email already exists";
        exit;
    }

    // Hash password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, ) VALUES (?, ?, ?, 'pending',)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request";
}
?>
