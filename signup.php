<?php
session_start();
include('db.php'); // DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];

    // // Optional: prevent SQL injection
    // $name = $conn->real_escape_string($name);
    // $email = $conn->real_escape_string($email);
    // $password = $conn->real_escape_string($password);
    // $contact = $conn->real_escape_string($contact);
    // $address = $conn->real_escape_string($address);

    // Check for duplicate email
    $checkQuery = "SELECT * FROM signup WHERE email='$email'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        echo "<script>alert('Email already exists. Try with another.'); window.location.href='membership.php';</script>";
    } else {
        // Insert data
        $sql = "INSERT INTO signup (name, email, password, contact, address)
                VALUES ('$name', '$email', '$password', '$contact', '$address')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['username'] = $email;
            header("Location: membership22.php");
            exit();
        } else {
            echo "<script>alert('Error while inserting: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - PowerHouse Gym</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      background-image:url("gymimg1.jpg");
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-repeat: no-repeat;
      background-size: cover;
      justify-content: center;
    }

    .signup-box {
      background-color: rgba(0, 0, 0, 0.8);
      border: 2px solid #d4ff00;
      box-shadow: 0 0 20px #d4ff00;
      padding: 40px 30px;
      border-radius: 12px;
      width: 100%;
      max-width: 450px;
      color: white;
    }

    .signup-box h1 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 32px;
    }

    .signup-box input,
    .signup-box textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 6px;
      border: none;
      background-color: #e3ebf7;
      color: black;
    }

    .signup-box textarea {
      resize: none;
    }

    .signup-box input::placeholder,
    .signup-box textarea::placeholder {
      color: black;
      font-weight: bold;
    }

    .signup-box button {
      width: 100%;
      padding: 12px;
      border-radius: 25px;
      background-color: #bad436ff;
      color: black;
      font-size: 16px;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: background-color 0.3s ease;
      margin-top: 10px;
    }

      .signup-box button:hover {
      background-color: rgb(48, 39, 167);
      color: rgb(64, 224, 208);
    }

    @media (max-width: 500px) {
      .signup-box {
        padding: 25px 20px;
      }
    }
  </style>
</head>
<body>

  <div class="signup-box">
    <h1>Sign Up</h1>
    <!-- <form action="signup.php" method="post"> -->
        <!-- <form action="membership.php" method="post"> -->
    <!-- <form action="http://localhost/gym/membership.php" method="post" autocomplete="off"> -->
      
      <!-- <form action=http://localhost/gym/signup2.php method="post" autocomplete="off"> -->
        <form action="" method="post" autocomplete="off">
      <input type="text" name="name" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email Address" required />
      <input type="password" name="password" placeholder="Password" required />
      <input type="text" name="contact" placeholder="Contact Number" required />
      <textarea name="address" rows="3" placeholder="Address"></textarea>
      <button type="submit">Sign Up</button>
        
      <!-- <button type="submit"><a href="http://localhost/gym/membership.php">Sign Up</a></button> -->
    </form>
  </div>

</body>
</html>

