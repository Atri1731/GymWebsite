<?php
session_start();
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    $sql = "SELECT * FROM admin WHERE email = '$email' AND role = 'Admin'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_email'] = $admin['email'];
        $_SESSION['admin_name'] = $admin['name'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "❌ Invalid admin email or not authorized.";
    }

    $conn->close();
}
?>
