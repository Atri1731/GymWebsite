<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Login - PowerHouse Gym</title>
</head>
<body>
  <h2>Admin Login</h2>
  <form action="admin_auth.php" method="POST">
    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <input type="submit" value="Login">
  </form>
</body>
</html> -->


<?php
session_start();
include('db.php'); // Your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the user exists in the admin table
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['name'];

        header("Location: admin.php");
        exit();
    } else {
        echo "<script>alert('Access denied. Only admin can log in.'); window.location.href='admin_login.php';</script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Login - PowerHouse Gym</title>
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
    <h1>Admin Login</h1>
    <form method="POST" action="admin_auth.php" autocomplete="off">
      <input type="email" name="email" placeholder="Enter Admin Email" autocomplete="off" required>
      <input type="password" name="password" placeholder="Enter Password" autocomplete="new-password" required>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
