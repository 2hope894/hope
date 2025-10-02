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
        // Store session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        if ($user['role'] === 'admin') {
            header("Location: Admin/dashboard.php");
        } else {
            header("Location: my_account.php");
        }
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
    $role = $_POST['role']; // Take role from dropdown

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
            $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);
            $stmt->execute();
            $register_success = ucfirst($role) . " registration successful! Please login.";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login / Register - Job Portal</title>
  <style>
body  {
  font-family: Arial, sans-serif;
  margin: 0; padding: 0;
  background-image: url(css/background.jpg);
  background-size: cover;
  background-position: center;
  color: black;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}
.form-container {
  width: 400px; margin: 120px auto; padding: 25px;
  background: #fff; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.15);
}
.form-container input, .form-container select {
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
  <form method="POST" action="" onsubmit="return validateLoginForm()">
      <input type="email" id="loginEmail" name="email" placeholder="Email" required>
      <input type="password" id="loginPassword" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
  </form>
  <p>Don't have an account? <a onclick="showRegister()">Register</a></p>
</div>

<!-- REGISTER FORM -->
<div class="form-container hidden" id="registerForm">
  <h2>Register</h2>
  <?php if (isset($register_error)) echo "<p style='color:red;'>".htmlspecialchars($register_error)."</p>"; ?>
  <form method="POST" action="" onsubmit="return validateRegisterForm()">
      <input type="text" id="regName" name="name" placeholder="Full Name" required>
      <input type="email" id="regEmail" name="email" placeholder="Email" required>
      <input type="password" id="regPassword" name="password" placeholder="Password" required>
      <input type="password" id="regConfirmPassword" name="confirm_password" placeholder="Confirm Password" required>

      <!-- Always show role selector -->
      <select name="role" id="regRole" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
      </select>

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

  // ✅ Improved JavaScript Validation with per-field feedback
  function validateLoginForm() {
    const email = document.getElementById("loginEmail").value.trim();
    const password = document.getElementById("loginPassword").value.trim();
    const emailPattern = /^[^@]+@[^@]+\.[^@]+$/;

    // Email check
    if (email === "") {
      alert("⚠ Email field cannot be empty.");
      return false;
    } else if (!emailPattern.test(email)) {
      alert("⚠ Invalid email format.");
      return false;
    } else {
      alert("✅ Email looks good.");
    }

    // Password check
    if (password === "") {
      alert("⚠ Password field cannot be empty.");
      return false;
    } else if (password.length < 6) {
      alert("⚠ Password must be at least 6 characters.");
      return false} 
      else {
      alert("✅ Password entered.");
    }

    return true; // ✅ Allow form submission
  }

  function validateRegisterForm() {
    const name = document.getElementById("regName").value.trim();
    const email = document.getElementById("regEmail").value.trim();
    const password = document.getElementById("regPassword").value.trim();
    const confirmPassword = document.getElementById("regConfirmPassword").value.trim();
    const role = document.getElementById("regRole").value;
    const emailPattern = /^[^@]+@[^@]+\.[^@]+$/;

    // Name check
    if (name === "") {
      alert("⚠ Name field cannot be empty.");
      return false;
    } else if (name.length < 18) {
      alert("⚠ Name must be at least 18 characters.");
      return false;
    } else {
      alert("✅ Name looks good.");
    }

    // Email check
    if (email === "") {
      alert("⚠ Email field cannot be empty.");
      return false;
    } else if (!emailPattern.test(email)) {
      alert("⚠ Invalid email format.");
      return false;
    } else {
      alert("✅ Email looks good.");
    }

    // Password check
    if (password === "") {
      alert("⚠ Password cannot be empty.");
      return false;
    } else if (password.length < 6) {
      alert("⚠ Password must be at least 6 characters.");
      return false;
    } else {
      alert("✅ Password strength OK.");
    }

    // Confirm password check
    if (confirmPassword === "") {
      alert("⚠ Please confirm your password.");
      return false;
    } else if (password !== confirmPassword) {
      alert("⚠ Passwords do not match.");
      return false;
    } else {
      alert("✅ Passwords match.");
    }

    // Role check
    if (role === "") {
      alert("⚠ Please select a role.");
      return false;
    } else {
      alert("✅ Role selected: " + role);
    }

    return true; // ✅ Allow form submission
  }
</script>
