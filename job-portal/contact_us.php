<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Jobseekers - Job Portal</title>
  <link rel="stylesheet" href="css/style.css">
  <style>


    .container { 
      flex: 1;
      padding-top: 120px;
      text-align: center; 
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

     
  </style>
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

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
</div>

<!-- Mission -->
<h2 class="mission-title">Our Mission</h2>
<p class="mission-text">
  At JobPortal, we aim to help people get jobs and help employers connect with the right people.
</p>

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
