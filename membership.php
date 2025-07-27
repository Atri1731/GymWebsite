<?php
session_start(); // Add this at the very top (before include)
$email = $_SESSION['username']; // This assumes 'username' is email

include('db.php'); // This should contain your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $plan = $_POST['plan'];
    $email = $_SESSION['username']; // Get the email from session

    // Optional: You can store user's email via session or ask for it in form
    // Example (if using session): $email = $_SESSION['username'];

    $sql = "INSERT INTO membership (email,plan) VALUES ('$email','$plan')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Membership successfully added!'); 
        window.location.href='membership.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Membership - PowerHouse Gym</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      background-color: white;
      color: black;
    }

    header {
      display: flex;
      align-items: center;
      background-color: black;
      padding: 10px 20px;
    }

    header img {
      width: 80px;
      height: 80px;
      background-color: white;
      margin-right: 10px;
    }

    header p {
      font-size: 28px;
      font-weight: bold;
      color: white;
      margin-right: auto;
      padding-top: 10px;
    }

    header span {
      color: rgb(102, 255, 250);
    }

    .navbar {
      display: flex;
    }

    .navbar ul {
      list-style: none;
      display: flex;
      align-items: center;
      margin: 0;
    }

    .navbar li {
      display: inline-block;
      padding: 25px 15px;
      font-size: 17px;
      transition: transform 0.3s ease;
    }

    .navbar li:hover {
      transform: scale(1.1);
    }

    .navbar a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    .navbar a:hover {
      color: rgb(102, 255, 250);
    }

    .navbar .login-btn {
      background-color: rgb(229, 255, 0);
      color: black;
      padding: 6px 18px;
      border-radius: 25px;
      font-weight: bold;
    }

    .navbar .login-btn:hover {
      background-color: rgb(211, 220, 129);
    }

    .membership-section {
      padding: 60px 20px;
      text-align: center;
    }

    .membership-section h1 {
      color: black;
      font-size: 36px;
      margin-bottom: 20px;
    }

    .membership-section p {
      font-size: 18px;
      color: #444;
      margin-bottom: 40px;
    }

    .plans-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .plan-card {
      background-color: black;
      border: 2px solid rgb(229, 255, 0);
      border-radius: 10px;
      width: 280px;
      padding: 30px 20px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      transition: transform 0.3s ease;
    }

    .plan-card:hover {
      transform: scale(1.05);
    }

    .plan-title {
      font-size: 22px;
      color: rgb(216, 211, 211);
      margin-bottom: 15px;
      font-weight: bold;
    }

    .plan-price {
      font-size: 28px;
      color: white;
      margin-bottom: 15px;
    }

    .plan-features {
      list-style: none;
      padding: 0;
      margin-bottom: 20px;
    }

    .plan-features li {
      padding: 8px 0;
      font-size: 16px;
      color: #c6b6b6;
    }

    .btn-join {
      background-color: rgb(78, 71, 71);
      color: white;
      border: 2px solid rgb(229, 255, 0);
      padding: 10px 25px;
      border-radius: 25px;
      font-weight: bold;
      text-decoration: none;
      display: inline-block;
      transition: background-color 0.3s ease;
    }

    .btn-join:hover {
      background-color: rgb(102, 255, 250);
      color: black;
    }
/* 
    footer {
      background-color: black;
      color: #aaa;
      text-align: center;
      padding: 20px;
      margin-top: 50px;
    } */

    .footer {
  background-color: black;
  color: white;
  padding: 40px 20px 20px;
  font-family: Arial, sans-serif;
}

.footer-container {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 30px;
  max-width: 1200px;
  margin: auto;
}

.footer-column {
  flex: 1;
  min-width: 250px;
}

.footer-column h3 {
  color: rgb(229, 255, 0);
  margin-bottom: 12px;
}

.footer-column p, .footer-column li {
  color: #ccc;
  margin: 6px 0;
  font-size: 14px;
}

.footer-column ul {
  list-style: none;
  padding-left: 0;
}

.footer-column a {
  text-decoration: none;
  color: #ccc;
}

.footer-column a:hover {
  color: rgb(102, 255, 250);
}

.social-icon {
  width: 24px;
  height: 24px;
  margin-top: 10px;
}

.footer-bottom {
  text-align: center;
  border-top: 1px solid #444;
  padding-top: 20px;
  font-size: 13px;
  color: #aaa;
  margin-top: 30px;
}

  </style>
</head>
<body>

  <!-- Header / Navbar -->
  <header>
    <img src="PHGym.png" alt="Gym Logo" />
    <p>PowerHouse <span>Gym</span></p>
    <nav class="navbar">
      <ul>
        <li><a href="home.html">Home</a></li>   
        <li><a href="about.html">About Us</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="membership.php">Membership</a></li>
        <li><a href="trainers.html">Trainers</a></li>
        <li><a href="gallery.html">Gallery</a></li>
        <li><a href="contact.html">Contact Us</a></li>
        <li><a href="reviews.html">Review</a></li>
        <li><a href="signin.php" class="login-btn">Login</a></li>
      </ul>
    </nav>
  </header>

  <!-- Membership Section -->
  <section class="membership-section">
    <h1>Choose Your Membership Plan</h1>
    <p>Flexible and affordable membership options designed to fit your lifestyle.</p>

    <div class="plans-container"><div class="plan-card">
        <div class="plan-title">Basic Plan</div>
        <div class="plan-price">₹999 / month</div>
        <ul class="plan-features">
          <li>Gym Access</li>
          <li>Locker & Shower</li>
          <li>1 Group Class/week</li>
        </ul>
        
        <form action="membership.php" method="post">
        
        <input type="hidden" name="plan" value="Basic Plan">
        <button type="submit" class="btn-join">Join Now</button>
        </form>

      </div>

      <div class="plan-card">
        <div class="plan-title">Standard Plan</div>
        <div class="plan-price">₹1499 / month</div>
        <ul class="plan-features">
          <li>Everything in Basic</li>
          <li>Unlimited Group Classes</li>
          <li>Diet Plan Included</li>
        </ul>
        
         <form action="membership.php" method="post">
        
        <input type="hidden" name="plan" value="Standard Plan">
        <button type="submit" class="btn-join">Join Now</button>
        </form>

      </div>

      <div class="plan-card">
        <div class="plan-title">Premium Plan</div>
        <div class="plan-price">₹2499 / month</div>
        <ul class="plan-features">
          <li>All Standard Features</li>
          <li>Personal Trainer Support</li>
          <li>Massage & Sauna Access</li>
        </ul>
        
         <form action="membership.php" method="post">
           
         <input type="hidden" name="plan" value="Premium Plan">
         <button type="submit" class="btn-join">Join Now</button>
        </form>

      </div>

    </div>
  </section>

  <!-- Footer -->
  <!-- <footer>
    &copy; 2025 PowerHouse Gym. All Rights Reserved.
  </footer> -->

  <footer class="footer">
  <div class="footer-container">
    
    <!-- Column 1: About -->
    <div class="footer-column">
      <h3 style="color: red;">PowerHouse Gym</h3>
      <p>Your destination for strength, energy, and transformation. <br>
         Join our community and crush your fitness goals!</p>
    </div>

    <!-- Column 2: Quick Links -->
    <div class="footer-column">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="home.html">› Home</a></li>
        <li><a href="about.html">› About Us</a></li>
        <li><a href="services.html">› Services</a></li>
        <li><a href="membership.html">› Membership</a></li>
        <li><a href="trainers.html">› Trainers</a></li>
        <li><a href="gallery.html">› Gallery</a></li>
        <li><a href="contact.html">› Contact</a></li>
        <li><a href="reviews.html">› Review</a></li>
      </ul>
    </div>

    <!-- Column 3: Contact Info -->
    <div class="footer-column">
      <h3>Contact Us</h3>
      <p>Email: powerhousegym@gmail.com</p>
      <p>Phone: +91 9898683867</p>
      <p>Location: Valsad, Gujarat, India</p>
      <a href="https://www.instagram.com/_powerhousegym._" target="_blank">
        <img src="instagram.png" alt="Instagram" class="social-icon">
      </a>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 <strong>PowerHouse Gym</strong>. All Rights Reserved.</p>
  </div>
</footer>

</body>
</html>
