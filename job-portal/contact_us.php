<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Jobseekers - Job Portal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0; padding: 0;
      background-image: url("css/background.jpg");
      background-size: cover;
      background-position: center;
      color: white; 
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 25px;
      background: rgba(0,0,0,0.6);
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 10;
    }
    nav a { 
      color: white; 
      margin: 0 15px;
      text-decoration: none; 
    }
    nav a:hover { text-decoration: underline; }

    .btn-top {
      padding: 10px 20px;
      background-color: rgba(19,114,215,0.9);
      color: white;
      margin-right: 40px;
      font-size: 16px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: background 0.3s;
    }
    .btn-top:hover { background-color: rgba(0,86,179,0.9); }

    .container { 
      flex: 1;
      padding-top: 120px;
      text-align: center; 
    }

    .label-logo {
      font-size: 28px;
      font-weight: bold;
      font-family: 'Segoe UI', Arial, sans-serif;
      text-decoration: none;
      color: #1e90ff;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
      transition: transform 0.3s, color 0.3s;
    }
    .label-logo span { color: #ff6600; }
    .label-logo:hover {
      transform: scale(1.05);
      color: #00bfff;
    }

    

    /* New styles for contact section */
    .contact-section {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-top: 40px;
      padding: 20px;
      text-align: left;
    }

    .contact-left, .contact-right {
      flex: 1;
      padding: 20px;
      background: rgba(255,255,255,0.8);
      color: black;
      border-radius: 8px;
      margin: 10px;
    }

    .contact-left h2, .contact-right h2 {
      margin-top: 0;
    }

    .contact-left p {
      margin: 8px 0;
      font-size: 16px;
    }


    .form-slot img {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    .contact-form label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }

    .contact-form input, .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .contact-form button {
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #1e90ff;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    .contact-form button:hover {
      background-color: #0066cc;
    }

     footer {
      background-color: rgba(0,0,0,0.7);
      color: white;
      padding: 20px 40px 10px 40px;
      font-size: 14px;
    }

    .footer-top {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      flex-wrap: wrap;
    }

    .footer-logo {
      text-align: right;
    }

    .company-info {
      text-align: left;
    }

    .company-info h4 {
      margin-bottom: 8px;
    }

    .company-info a {
      display: block;
      color: #fff;
      text-decoration: none;
      margin-bottom: 6px;
      transition: color 0.2s ease;
    }
    .company-info a:hover { color: #ccc; }

    .social-section {
      text-align: center;
      margin-top: 20px;
    }
    .social-section h3 {
      margin-bottom: 10px;
    }
    .social-icons {
      display: flex;
      justify-content: center;
      gap: 15px;
      background-color: #0056b3;
    }
    .social-icons a img {
      width: 40px;
      height: 40px;
      transition: transform 0.3s;
    }
    .social-icons a img:hover {
      transform: scale(1.2);
    }

    .footer-bottom {
      text-align: center;
      margin-top: 15px;
      font-size: 13px;
    }

  </style>
</head>
<body>

<header>
  <div>
    <a href="index.php" class="label-logo">Job<span>Portal</span></a>
  </div>

  <nav>
    <a href="contact_us.php">Contact us</a>
    <a href="terms_conditions.php">Terms & Conditions</a>
    <a href="about.php">About Us</a>
  </nav>
  <div>
    <a href="auth.php" class="btn-top">Login / Register</a>
  </div>
</header>

<div class="container">
  <h1 style="font-size: 36px; margin-bottom: 20px;">Contact Us</h1>

  <div class="contact-section">
    <!-- Left side -->
    <div class="contact-left">
      <a href="index.php" class="label-logo">Job<span>Portal</span></a>
      <p><strong>Phone (Zambia):</strong> +260 97 123 4567</p>
      <p><strong>Phone (International):</strong> +1 234 567 890</p>
      <p><strong>Email:</strong> info@jobportal.com</p>

      <h3>Social Media</h3>
      <div class="social-icons">
      <a href="#" target="_blank"><img src="css/facebook.png" alt="Facebook"></a>
      <a href="#" target="_blank"><img src="css/google.png" alt="Google"></a>
      <a href="#" target="_blank"><img src="css/instagram.png" alt="Instagram"></a>
      <a href="#" target="_blank"><img src="css/telegram.png" alt="Telegram"></a>
      <a href="#" target="_blank"><img src="css/whatsapp.png" alt="WhatsApp"></a>
      </div>
    </div>

    <!-- Right side -->
    <div class="contact-right">
      <div class="form-slot">
        <!-- Image slot -->
        <img src="css/regi.jpg" alt="Form Image">
      </div>
      <p>Use the JobPortal form to send your questions or comments:</p>
      <form class="contact-form">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email">

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" placeholder="Enter your message"></textarea>

        <button type="submit">Send</button>
      </form>
    </div>
  </div>
  <h2 style="font-size: 36px; margin-bottom: 20px; background: rgba(0,0,0,0.6); color: white; padding: 10px; border-radius: 6px; box-shadow: 2px 2px 8px rgba(0,0,0,0.7);">
  Our Mission
</h2>

<p style="background: rgba(255,255,255,0.8); color: black; padding: 12px; border-radius: 6px; box-shadow: 2px 2px 8px rgba(0,0,0,0.5);">
  At jobportal, we aim to help people to get jobs and help employers connect with the right people
</p>
</div>

<!-- Footer -->
<footer>
  <div class="footer-top">
    <div class="company-info">
      <h4>Company Info</h4>
      <a href="about.php">About Us</a>
      <a href="terms_conditions.php">Terms & Conditions</a>
      <a href="contact_us.php">Contact Us</a>
    </div>

    <div class="footer-logo">
      <a href="index.php" class="label-logo">Job<span>Portal</span></a>
    </div>
  </div>

  <!-- Social Media Section -->
  <div class="social-section">
    <h3>Follow Us</h3>
    <div class="social-icons">
      <a href="#" target="_blank"><img src="css/facebook.png" alt="Facebook"></a>
      <a href="#" target="_blank"><img src="css/google.png" alt="Google"></a>
      <a href="#" target="_blank"><img src="css/instagram.png" alt="Instagram"></a>
      <a href="#" target="_blank"><img src="css/telegram.png" alt="Telegram"></a>
      <a href="#" target="_blank"><img src="css/whatsapp.png" alt="WhatsApp"></a>
      <!-- Add more social links here -->
    </div>
  </div>

  <!-- Copyright -->
  <div class="footer-bottom">
    <p>&copy; 2025 Job Portal. All rights reserved.</p>
  </div>
</footer>

</body>
</html>
