<?php
include 'db.php'; // DB connection

// Handle form submission to add user as admin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    // Get user data from signup table
    $stmt = $conn->prepare("SELECT id,name, email FROM signup WHERE id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $name = $user['name'];
        $email = $user['email'];
        $role = 'Admin'; // Default role

        // Insert into admin table
        $insertStmt = $conn->prepare("INSERT INTO admin (id, name, email, role) VALUES (?, ?, ?)");
        $insertStmt->bind_param("$id", $name, $email, $role);

        if ($insertStmt->execute()) {
            echo "<script>alert('User added as admin!'); window.location.href='admin2.php';</script>";
        } else {
            echo "Error inserting: " . $insertStmt->error;
        }
        $insertStmt->close();
    } else {
        echo "User not found.";
    }
    $stmt->close();
}

// Fetch all users from signup table
$users = $conn->query("SELECT id, name, email FROM signup");

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Admin From Users</title>
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

<h2>Select a User to Add as Admin</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Add as Admin</th>
    </tr>

    <?php if ($users->num_rows > 0): ?>
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
        <tr><td colspan="3">No users found</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
