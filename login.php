<?php
session_start();
include("db/db.php");
$error = '';

if (isset($_POST["login"])) {
    $user = mysqli_real_escape_string($conn, $_POST["username"]);
    $pass = sha1($_POST["password"]);
    $query = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['role'] = $row['role'];
        if ($row['role'] == 'admin') {
            header('Location: admin/index.php');
        } else {
            header('Location: index.html');
        }
        exit();
    } else {
        $error = 'Login failed. Please check your credentials.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Login</h1>
        <nav>
            <a href="index.html">Home</a>
        </nav>
    </header>

    <main>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Log In</button>
        </form>
    </main>
</body>

</html>