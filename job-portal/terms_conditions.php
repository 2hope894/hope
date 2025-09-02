<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Employers - Job Portal</title>
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
    header { display: flex; justify-content: space-between; align-items:center; padding:15px 25px; background: rgba(0,0,0,0.6); position:fixed; top:0;width:100%; z-index:10;}
    nav a { color:white; margin:0 15px; text-decoration:none; }
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

    .container { flex:1; padding-top:100px; text-align:center; max-width: 1000px; margin: 0 auto; }

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

    

    /* Terms & Conditions section styles */
    .tc-section { text-align: left; margin: 18px auto; }
    .tc-heading {
      font-size: 24px;
      margin: 16px 0 8px;
      background: rgba(0,0,0,0.6);
      color: #fff;
      padding: 10px;
      border-radius: 6px;
      box-shadow: 2px 2px 8px rgba(0,0,0,0.7);
    }
    .tc-card {
      background: rgba(255,255,255,0.85);
      color: #111;
      padding: 12px 14px;
      border-radius: 6px;
      box-shadow: 2px 2px 8px rgba(0,0,0,0.5);
      line-height: 1.6;
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
    <a href="terms_conditions.php">Terms & conditions</a>
    <a href="about.php">About Us</a>
  </nav>
  <div>
    <a href="auth.php" class="btn-top">Login / Register</a>
  </div>
</header>

<div class="container">
  <h1>Terms and Conditions</h1>
  



  <!-- NEW: Terms & Conditions sections -->
  <section class="tc-section">
    <h3 class="tc-heading">General</h3>
    <div class="tc-card">
      <p>
        These Terms and Conditions (“Terms”) govern your access to and use of this website and any related
        services (collectively, the “Platform”). By accessing or using the Platform, you agree to be bound by
        these Terms. If you do not agree, you must not use the Platform. We may update these Terms from time
        to time, and continued use constitutes acceptance of the updated Terms.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Information Purposes</h3>
    <div class="tc-card">
      <p>
        Content on the Platform is provided for general information only. While we strive to keep information
        accurate and current, we make no warranties, representations, or guarantees—express or implied—about
        completeness, accuracy, reliability, suitability, or availability with respect to any content,
        employers, candidates, or third-party services referenced on the Platform.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Browse at Your Risk</h3>
    <div class="tc-card">
      <p>
        Your use of the Platform is at your own risk. We do not guarantee that the Platform will be secure,
        uninterrupted, or error-free. You are responsible for implementing sufficient safeguards (including
        antivirus and backup procedures) to satisfy your requirements for data integrity and security.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">User Indemnity</h3>
    <div class="tc-card">
      <p>
        To the fullest extent permitted by law, you agree to indemnify, defend, and hold harmless JobPortal,
        its affiliates, and their respective officers, employees, and agents from and against any and all
        claims, liabilities, damages, losses, and expenses (including reasonable legal fees) arising out of or
        in any way connected with your use of the Platform, your content, your breach of these Terms, or your
        violation of any law or the rights of a third party.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Intellectual Property</h3>
    <div class="tc-card">
      <p>
        The Platform and all materials on it, including text, graphics, logos, icons, images, software, and
        design elements, are owned by or licensed to JobPortal and are protected by intellectual property laws.
        Except as expressly permitted, you may not copy, reproduce, modify, distribute, display, or create
        derivative works from any part of the Platform without our prior written consent.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Use of Material</h3>
    <div class="tc-card">
      <p>
        You may view, download, and print materials from the Platform for your personal, non-commercial use
        only, provided that you do not remove any copyright, trademark, or other proprietary notices. Any other
        use—such as scraping, bulk downloading, framing, mirroring, or commercial exploitation—requires our
        prior written permission and may result in immediate suspension or termination of access.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Waiver</h3>
    <div class="tc-card">
      <p>
        No failure or delay by JobPortal in exercising any right or remedy under these Terms shall constitute a
        waiver of that or any other right or remedy. A waiver will be effective only if it is in writing and
        signed by an authorized representative of JobPortal.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Severability</h3>
    <div class="tc-card">
      <p>
        If any provision of these Terms is found to be invalid, illegal, or unenforceable, that provision shall
        be enforced to the maximum extent permissible and the remaining provisions shall remain in full force
        and effect.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Data Protection</h3>
    <div class="tc-card">
      <p>
        We handle personal data in accordance with applicable data protection laws and our privacy practices.
        By using the Platform, you consent to the collection, use, and disclosure of your information as
        reasonably necessary to provide the services and as described in our privacy notices. You are
        responsible for ensuring the accuracy of any personal data you submit and for maintaining the
        confidentiality of your account credentials.
      </p>
    </div>
  </section>

  <section class="tc-section">
    <h3 class="tc-heading">Zambia Law Applies</h3>
    <div class="tc-card">
      <p>
        These Terms, their subject matter, and their formation are governed by the laws of the Republic of
        Zambia. You agree to the exclusive jurisdiction of the courts of Zambia for the resolution of any
        disputes arising out of or in connection with your use of the Platform and these Terms.
      </p>
    </div>
  </section>
  <!-- END NEW SECTIONS -->

</div>

  <h2 style="font-size: 36px; margin-bottom: 20px; background: rgba(0,0,0,0.6); color: white; padding: 10px; border-radius: 6px; box-shadow: 2px 2px 8px rgba(0,0,0,0.7); text-align: center;">
    Our Mission
  </h2>

  <p style="background: rgba(255,255,255,0.8); color: black; padding: 12px; border-radius: 6px; box-shadow: 2px 2px 8px rgba(0,0,0,0.5); text-align: center;">
    At JobPortal, we aim to help people get jobs and help employers connect with the right people.
  </p>

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
