<?php
session_start();
include 'users.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['user'] = $user;
            header('Location: dashboard.php');
            exit;
        }
    }
    $error = "Invalid login credentials!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body class="background">
    <form method="POST" class="form">
        <img src="assets/mcoLogo.png" alt="logo" class="logo" />
        <input name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">LOG-IN</button><br>
        
        <?php if (!empty($error)) echo "<p>$error</p>"; ?>
        <a href="signup.php">SIGN-IN</a>
    </form>
</body>
</html>
