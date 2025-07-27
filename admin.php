<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php'; // DB connection

// Handle form submission to add user as admin (NO PASSWORD)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Get user data from signup table
    $stmt = $conn->prepare("SELECT id, name, email FROM signup WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $id = $user['id'];
        $name = $user['name'];
        $email = $user['email'];
        $role = 'Admin';

        // Check if user is already an admin
        $check = $conn->prepare("SELECT id FROM admin WHERE id = ?");
        $check->bind_param("i", $id);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            echo "<script>alert('❌ User is already an admin!'); window.location.href='admin.php';</script>";
        } else {
            // Insert into admin table (without password)
            $insertStmt = $conn->prepare("INSERT INTO admin (id, name, email, role) VALUES (?, ?, ?, ?)");
            $insertStmt->bind_param("isss", $id, $name, $email, $role);

            if ($insertStmt->execute()) {
                echo "<script>alert('✅ User added as admin successfully!'); window.location.href='admin.php';</script>";
            } else {
                echo "<p style='color:red;'>❌ Error inserting into admin: " . $insertStmt->error . "</p>";
            }
            $insertStmt->close();
        }
        $check->close();
    } else {
        echo "<p style='color:red;'>❌ User not found in signup table.</p>";
    }
    $stmt->close();
}

// Fetch all users from signup table
$users = $conn->query("SELECT id, name, email FROM signup");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin From Users (No Password)</title>
    <style>
        body {
            font-family: Arial;
            padding: 20px;
            background: #f4f4f4;
        }
        table {
            width: 80%;
            margin: auto;
            background: #fff;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        h2 {
            text-align: center;
        }
        button {
            padding: 5px 10px;
        }
    </style>
</head>
<body>

<h2>Select a User to Add as Admin (No Password)</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Add as Admin</th>
    </tr>

    <?php if ($users && $users->num_rows > 0): ?>
        <?php while ($row = $users->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="user_id" value="<?= $row['id'] ?>">
                        <button type="submit">Add Admin</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">No users found in signup table.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
