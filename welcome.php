<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: signin.html");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Welcome - PowerHouse Gym</title>
  <style>
    body {
      background: linear-gradient(to right, #1e1e1e, #333);
      color: #ffffff;
      font-family: Arial, sans-serif;
      text-align: center;
      padding-top: 100px;
    }

    .container {
      background: #111;
      border: 2px solid #d4ff00;
      padding: 40px;
      border-radius: 10px;
      display: inline-block;
    }

    h1 {
      font-size: 36px;
      color: #d4ff00;
    }

    p {
      font-size: 20px;
      margin-top: 20px;
    }

    .logout-btn {
      margin-top: 30px;
      padding: 10px 25px;
      font-size: 16px;
      background-color: red;
      color: white;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-weight: bold;
    }

    .logout-btn:hover {
      background-color: darkred;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
    <p>You have successfully logged in to PowerHouse Gym.</p>

    <form action="signout.php" method="post">
      <button class="logout-btn" type="submit">Logout</button>
    </form>
  </div>

</body>
</html>
