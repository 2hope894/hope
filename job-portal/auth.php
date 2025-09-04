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
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $register_error = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $register_error = "Email already registered!";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $hashed_password);
            $stmt->execute();
            $register_success = "Registration successful! Please login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login / Register - Job Portal</title>
  <style>
body {
      font-family: Arial, sans-serif;
      margin: 0; padding: 0;
      background-image: url("css/background.jpg"); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: black;
    }

    /* Header Styling */
    .header {
      width: 100%;
      background: #fff;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
    
    }
  
    
    .header a {
      text-decoration: none;
      color: #1e90ff;
      font-weight: normal;
    }
    .form-container {
      width: 400px; margin: 120px auto 40px auto; padding: 25px;
      background: #fff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    .form-container input {
      width: 100%; padding: 12px; margin: 8px 0;
      border: 1px solid #ddd; border-radius: 8px;
    }
    .form-container button {
      width: 100%; padding: 12px; margin-top: 10px;
      background: #1e90ff; color: #fff; border: none; border-radius: 8px;
      cursor: pointer;
    }
    .form-container button:hover { background: #0056b3; }
    a { color:#1e90ff; cursor:pointer; }
    .hidden { display:none; }
  </style>
  
</head>
<body>


<!-- LOGIN FORM -->
<div class="form-container" id="loginForm">
  <h2>Login</h2>
  <?php if (isset($login_error)) echo "<p style='color:red;'>".htmlspecialchars($login_error)."</p>"; ?>
  <?php if (isset($register_success)) echo "<p style='color:green;'>".htmlspecialchars($register_success)."</p>"; ?>
  <form method="POST" action="">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
  </form>
  <p>Don't have an account? <a onclick="showRegister()">Register</a></p>
</div>

<!-- REGISTER FORM -->
<div class="form-container hidden" id="registerForm">
  <h2>Register</h2>
  <?php if (isset($register_error)) echo "<p style='color:red;'>".htmlspecialchars($register_error)."</p>"; ?>
  <form method="POST" action="">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <button type="submit" name="register">Register</button>
  </form>
  <p>Already have an account? <a onclick="showLogin()">Login</a></p>
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
