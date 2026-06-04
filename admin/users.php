<?php

include("../db/db.php");
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users");

if (isset($_POST["add"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $pass = sha1($_POST["password"]);
    $role = mysqli_real_escape_string($conn, $_POST["role"]);
    mysqli_query($conn, "INSERT INTO users (username,password,role) VALUES('$username', '$pass', '$role')");
    header("Location: users.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>

<body>
    <h2>User Management</h2>
    <form action="" method="post">
        <input type="text" name="username" id="" placeholder="Username" required>
        <input type="password" name="password" id="" placeholder="Password" required>
        <select name="role" id="">
            <option value="buyer">Buyer</option>
            <option value="seller">Seller</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit" name="add">Add User</button>
    </form>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['username'] ?></td>
                <td><?= $row['role'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>