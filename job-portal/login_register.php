<?php
session_start();
include 'db.php';

// LOGIN logic
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        header("Location: dashboard.php");
        exit();
    } else {
        $login_error = "Invalid email or password!";
    }
}

// REGISTER logic
if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        $register_error = "Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        $register_success = "Registration successful! Please login.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login & Register</title>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: Arial, sans-serif;
        height: 100vh;
        background-image: url("css/logi.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        background: rgba(0, 0, 0, 0.85);
        padding: 30px 40px;
        border-radius: 10px;
        box-shadow: 0px 5px 20px rgba(255,255,255,0.3);
        width: 100%;
        max-width: 350px;
        text-align: center;
        color: white;
    }

    h2 { margin-bottom: 20px; }

    input[type="text"], input[type="email"], input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 8px 0;
        border: none;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 6px;
        width: 100%;
        font-size: 16px;
        cursor: pointer;
    }
    .btn:hover { background-color: #0056b3; }

    p a {
        color: #ffd700;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
    }
    p a:hover { text-decoration: underline; }

    .hidden { display: none; }
</style>
</head>
<body>

<div class="form-container">

    <!-- Login Form -->
    <div id="loginForm">
        <h2>Login</h2>
        <?php if (isset($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>
        <?php if (isset($register_success)) echo "<p style='color:lightgreen;'>$register_success</p>"; ?>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a onclick="showRegister()">Register</a></p>
    </div>

    <!-- Register Form -->
    <div id="registerForm" class="hidden">
        <h2>Register</h2>
        <?php if (isset($register_error)) echo "<p style='color:red;'>$register_error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register" class="btn">Register</button>
        </form>
        <p>Already have an account? <a onclick="showLogin()">Login</a></p>
    </div>

</div>

<script>
    function showRegister() {
        document.getElementById("loginForm").classList.add("hidden");
        document.getElementById("registerForm").classList.remove("hidden");
    }
    function showLogin() {
        document.getElementById("registerForm").classList.add("hidden");
        document.getElementById("loginForm").classList.remove("hidden");
    }
</script>

</body>
</html>
