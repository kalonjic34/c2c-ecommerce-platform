<?php

include("../db/db.php");
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] != "admin") {
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM products");

if (isset($_POST["add"])) {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $price = mysqli_real_escape_string($conn, $_POST["price"]);
    mysqli_query($conn, "INSERT INTO products (name, description, price) VALUES('$name', '$description', '$price')");
    header("Location: products.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <h2>Product Management</h2>
    <form action="" method="post">
        <input type="text" name="name" id="" placeholder="Product Name" required>
        <textarea name="description" id="" placeholder="Description"></textarea>
        <input type="number" name="price" step="0.01" placeholder="Price" required>
        <button type="submit" name="add">Add Product</button>
    </form>
    <table border="1">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['price'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

</body>

</html>