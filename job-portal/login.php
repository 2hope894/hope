<?php
session_start();
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
    /* Reset default styles  */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body & Background */
body {
  font-family: Arial, sans-serif;
  height: 100vh;

  /* Background fallback color */
  background-color: #f4f4f4;

  /* Background image */
  background-image: url("css/logi.jpg"); 
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;

  /* Center form */
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

/* ===== Login Box ===== */
form {
  background: rgba(14, 9, 9, 0.9);
  padding: 30px 40px;
  border-radius: 10px;
  box-shadow: 0px 5px 20px rgba(227, 236, 237, 0.96);
  width: 100%;
  max-width: 350px;
  text-align: center;
}

/*Heading */
h2 {
  color: #333;
  margin-bottom: 20px;
  font-size: 24px;
  text-align: center;
}

/*  Error Message */
p[style] {
  margin-bottom: 15px;
  font-weight: bold;
}

/*Input Fields */
input[type="email"],
input[type="password"] {
  width: 100%;
  padding: 12px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 6px;
  font-size: 14px;
  outline: none;
}

input[type="email"]:focus,
input[type="password"]:focus {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0,123,255,0.5);
}

/* Button */
.btn {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 12px;
  border-radius: 6px;
  width: 100%;
  font-size: 16px;
  cursor: pointer;
  transition: background 0.3s ease;
}

.btn:hover {
  background-color: #0056b3;
}

/* Register Link */
p {
  margin-top: 15px;
  color: rgba; 
}

p a {
  color: #1f15d4ff;
  text-decoration: none;
  font-weight: bold;
}

p a:hover {
  text-decoration: underline;
}

/* Responsive Design */
@media (max-width: 480px) {
  form {
    padding: 20px;
    width: 90%;
  }

  h2 {
    font-size: 20px;
  }
}

  </style>
</head>
<body>
  <h2>Login</h2>
  <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  <form method="POST" action="">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" class="btn">Login</button>
  </form>
  <p>Don't have an account? <a href="register.php">Register</a></p>
</body>
</html>