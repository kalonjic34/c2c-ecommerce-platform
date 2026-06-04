<?php

session_start();
if (isset($_SESSION["role"]) && $_SESSION["role"] != 'admin') {

    header("Location:../login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h1>Dashboard</h1>
    <nav>
        <a href="users.php">Manage users</a>
        <a href="products.php">Manage Products</a>
        <a href="../logout.php">Log Out</a>
    </nav>
</body>

</html>