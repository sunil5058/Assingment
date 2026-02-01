<?php
session_start();
include 'db.php';

if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if($stmt->rowCount() > 0){
        echo "Email already registered!";
    } else {
        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $password // For production: use password_hash($password, PASSWORD_DEFAULT)
        ]);
        echo "Registration successful! <a href='login.php'>Login here</a>";
    }
}
?>

<h2>Register</h2>
<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="register">Register</button>
</form>
<a href="login.php">Login</a>
