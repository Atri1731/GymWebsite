<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Admin</title>
</head>
<body>
  <h2>Add Admin</h2>
  <form action="admin_insert.php" method="POST">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Role:</label><br>
    <select name="role">
      <option value="Admin">Admin</option>
      <option value="Trainer">Trainer</option>
    </select><br><br>

    <input type="submit" value="Add Admin">
  </form>
</body>
</html>
