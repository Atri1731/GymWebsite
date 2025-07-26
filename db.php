<?php
// db.php
$conn = new mysqli("localhost", "root", "", "Gym");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
