<?php
include "db.php";

if (isset($_POST['submit'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';

    $sql = "INSERT INTO users (name, email, password, role)
            VALUES (:name, :email, :password, :role)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':name'     => $name,
        ':email'    => $email,
        ':password' => $hashedPassword,
        ':role'     => $role
    ]);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <input type="submit" name="submit" value="Register">
</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</body>
</html>
