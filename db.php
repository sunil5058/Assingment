<?php
// Database configuration
$host = "localhost";
$dbname = "blogpostdb";
$user = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully"; // Uncomment to test
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
