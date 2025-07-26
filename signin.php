<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check user
    $sql = "SELECT * FROM signup WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $email;
        header("Location: admin.php"); // Go to secure page
        exit();
    } else {
        echo "<script>
          alert('Invalid email or password. Please sign up first if you are a new user.');
          window.location.href='admin.php';
        </script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign In - PowerHouse Gym</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, Helvetica, sans-serif;
      background-image: url("gymimg1.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .signin-box {
      background-color: rgba(0, 0, 0, 0.85);
      border: 2px solid #9db00e;
      box-shadow: 0 0 25px #9db00e;
      padding: 35px 30px;
      border-radius: 12px;
      width: 90%;
      max-width: 400px;
      color: white;
    }

    .signin-box h1 {
      text-align: center;
      margin-bottom: 25px;
    }

    .signin-box input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 6px;
      border: none;
      background-color: #e3ebf7;
      color: black;
    }

    .signin-box input::placeholder {
      color: black;
      font-weight: bold;
    }

    .signin-box button {
      width: 100%;
      padding: 12px;
      border-radius: 25px;
      background-color: #9db00e;
      color: black;
      font-weight: bold;
      font-size: 16px;
      border: none;
      cursor: pointer;
      margin-top: 10px;
    }

   .signin-box button:hover {
  background-color: rgb(48, 39, 167);
      color: rgb(64, 224, 208);
    }
  </style>
</head>
<body>
  <div class="signin-box">
    <h1>Sign In</h1>
    <!-- <form method="post" action="signin222.php" autocomplete="off">

    <input type="text" name="fakeusernameremembered" style="display:none">
    <input type="password" name="fakepasswordremembered" style="display:none">
        
      <input type="email" name="email" placeholder="Enter Email" autocomplete="new email" required />
      <input type="password" name="password" placeholder="Enter Password" autocomplete="off" required />
      <button type="submit">Login</button>
    </form> -->

<form method="post" action="signin222.php" autocomplete="off">
     <input type="text" name="fakeusernameremembered"  style="display:none" >
     <input type="password" name="fakepasswordremembered" style="display:none">
    
    <input type="email" name="email" placeholder="Enter Email" autocomplete="off" required />
    <input type="password" name="password" placeholder="Enter Password" autocomplete="new-password" required />
    <button type="submit">Signin</button>
</form>

  </div>
</body>
</html>
