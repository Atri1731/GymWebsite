<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: signin222.php");
    exit();
}

include('db.php');

// Initialize message variable
$popupMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_admin_id'])) {
    $userId = $_POST['add_admin_id'];

    // Get user details
    $stmt = $conn->prepare("SELECT name, email, password FROM signup WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($name, $email, $password);
    $stmt->fetch();
    $stmt->close();

    // Check if already in admin
    $check = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        $role = 'admin';
        $insert = $conn->prepare("INSERT INTO admin (name, email, role, password) VALUES (?, ?, ?, ?)");
        $insert->bind_param("ssss", $name, $email, $role, $password);
        $insert->execute();
        $insert->close();
        $popupMessage = "Admin added successfully.";
    } else {
        $popupMessage = "User is already an admin.";
    }

    $check->close();
}

// Fetch users
$result = $conn->query("SELECT * FROM signup");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }
        h2, h3 {
            text-align: center;
        }
        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ccc;
        }
        th {
            background: #333;
            color: white;
        }
        .btn {
            padding: 6px 12px;
            border: none;
            background-color: #333;
            color: white;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

<h2>Welcome, <?= $_SESSION['admin_name'] ?> (Admin)</h2>

<h3>Registered Users</h3>
<table>
    <tr>
        <th>ID</th><th>Name</th><th>Email</th><th>Contact</th><th>Address</th><th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['name'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><?= $row['contact'] ?></td>
        <td><?= $row['address'] ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="add_admin_id" value="<?= $row['id'] ?>">
                <button type="submit" class="btn">Add as Admin</button>
            </form>
        </td>
    </tr>
    <?php } ?>
</table>

<?php if (!empty($popupMessage)) : ?>
<script>
    alert("<?= $popupMessage ?>");
</script>
<?php endif; ?>

</body>
</html>
