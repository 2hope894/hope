<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>About Us - Job Portal</title>
  <link rel="stylesheet" href="css/portal.css">
  <style>
    .container {
       flex:1; 
       padding-top:100px; 
       text-align:center; 
       color: #000;
    } 
    .section {
       max-width: 900px;
       margin: 40px auto;
       padding: 0 20px;
       text-align: left;
    }
    .section h2 {
       color: #04020cff;
       margin-bottom: 10px;
    }
    .section p {
       line-height: 1.6;
       margin-bottom: 15px;
       color:black;
    }

    .tc-section { text-align: left; margin: 18px ; }
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

  
  </style>
</head>
<body>

<!-- Header -->
<?php include 'header.php'; ?>

<div class="container">
  <h1>About Us</h1>
  
</div>
         <section class="tc-section">
         <h3 class="tc-heading">Us</h3>
        <div class="tc-card">
          <p>Job Portal is dedicated to connecting jobseekers with employers across Ireland.
            Our mission is to make job search simple and effective.</p>
          <p>We provide a trusted platform where candidates can showcase their skills, build professional CVs,
              and apply for jobs with ease. Employers can post vacancies,<br> review applications, and find the right talent quickly.
              By bridging the gap between jobseekers and recruiters,<br> Job Portal ensures a
              smoother hiring process and supports career growth for individuals at all levels.</p>
         </div>
         </section>

   <section class="tc-section">
     <h3 class="tc-heading">Who We Are</h3>
     <div class="tc-card">
     <p>Job Portal is a team of passionate professionals who believe in the power of opportunities. 
     We understand the challenges that jobseekers face and the struggles employers go through when looking for the right talent.
     That is why we are committed to building a reliable, transparent, and user-friendly platform that works for everyone.</p>

     </div>
    </section>

     <section class="tc-section">
     <h3 class="tc-heading">What We Do</h3>
     <div class="tc-card">
       <p>We provide tools and resources that simplify the recruitment process.
        From job postings and resume uploads to smart filtering and application tracking,
        our platform is designed to save time and improve efficiency for both candidates and recruiters. 
        With Job Portal, finding a job or hiring talent is faster, easier, and more effective.</p>
     </div>
     </section>

       <section class="tc-section">
         <h3 class="tc-heading">Our Vision</h3>
          <div class="tc-card">
            <p>Our vision is to become the leading online job marketplace,
              empowering millions of people to achieve their career goals while helping organizations grow with the right workforce.
               We aim to redefine recruitment by making it accessible, innovative, and impactful for every individual and business.</p>
         </div>
        </section>

        <section class="tc-section">
         <h3 class="tc-heading">Our Values</h3>
          <div class="tc-card">
            <p><strong>Integrity:</strong> We are committed to transparency, honesty, and trust in everything we do.</p>
            <p><strong>Innovation:</strong> We continuously improve our platform to deliver modern solutions to recruitment challenges.</p>
            <p><strong>Accessibility:</strong> We believe in creating equal opportunities for all, regardless of background or location.</p>
            <p><strong>Collaboration:</strong> We strive to build long-lasting relationships between employers and candidates to foster mutual success.</p>

         </div>
        </section>

<!-- Mission -->
<h2 class="mission-title">Our Mission</h2>
<p class="mission-text">
  At JobPortal, we aim to help people get jobs and help employers connect with the right people.
</p>

  

<!-- Footer -->
<?php include 'footer.php'; ?>

</body>
</html>
