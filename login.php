<?php
session_start();
include("db/db.php");

if (isset($_POST["login"])) {
    $user = $_POST["username"];
    $pass = sha1($_POST["password"]);
    $query = "SELECT * FROM user WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == 'admin') {
            header('Location: admin/index.php');
        } else {
            header('Location: index.html');
        }
    } else {
        echo "Login failed. Please check your credentials";
    }

}
?>