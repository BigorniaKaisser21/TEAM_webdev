<?php
$host = 'localhost';      // or 127.0.0.1
$db   = 'swipeandSwitch';  // name of your database
$user = 'root';  // MySQL username (often 'root' locally)
$pass = '';  // MySQL password

$dsn = "localhost=$host;swipeandSwitch=$db;";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,  // better error handling
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,        // associative arrays
    PDO::ATTR_EMULATE_PREPARES   => false,                   // real prepared statements
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
