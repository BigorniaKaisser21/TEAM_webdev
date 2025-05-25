<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newUser = [
        'username' => $_POST['username'],
        'email' => $_POST['email'],
        'password' => $_POST['password']
    ];
    
    // Normally you'd write to a database here
    $_SESSION['user'] = $newUser;
    header(header: 'Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Sign Up</title>
</head>
<body class="background">
    <form method="POST" class="form">
        <img src="assets/mcoLogo.png" alt="logo" class="logo" />
        <input name="username" placeholder="Username" required />
        <input name="email" placeholder="Email" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">SIGN-IN</button><br>
        <a href="login.php">LOG-IN</a>
    </form>
</body>
</html>
