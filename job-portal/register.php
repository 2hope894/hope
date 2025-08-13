<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();
    if ($result->num_rows > 0) {
        $error = "Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        header("Location: login.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      height: 100vh;
      background-color: #f4f4f4;
      background-image: url("css/regi.jpg"); 
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    form {
      background: rgba(255, 255, 255, 0.9);
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0px 5px 20px rgba(0,0,0,0.2);
      width: 100%;
      max-width: 350px;
      text-align: center;
    }

    h2 {
      color: #333;
      margin-bottom: 20px;
      font-size: 24px;
    }

    p[style] {
      margin-bottom: 15px;
      font-weight: bold;
    }

    input[type="text"],
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

    input:focus {
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0,123,255,0.5);
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
      transition: background 0.3s ease;
    }

    .btn:hover {
      background-color: #0056b3;
    }

    p {
      margin-top: 15px;
      color: rgba;
    }

    p a {
      color: #ffd700;
      text-decoration: none;
      font-weight: bold;
    }

    p a:hover {
      text-decoration: underline;
    }

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
  <form method="POST" action="">
    <h2>Register</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" class="btn">Register</button>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </form>
</body>
</html>
