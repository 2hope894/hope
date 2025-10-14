<?php
include 'db_connect.php'; // your database connection file

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "success";
    } else {
        echo "invalid_credentials";
    }
} else {
    echo "missing_parameters";
}
?>
