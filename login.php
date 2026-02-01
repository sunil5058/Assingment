<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email AND password = :password");
    $stmt->execute(['email'=>$email, 'password'=>$password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['user_role'];
        $_SESSION['user_name'] = $user['name'];

        if($user['user_role'] == 'admin'){
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        echo "Invalid login!";
    }
}
?>

<h2>Login</h2>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit" name="login">Login</button>
</form>
<a href="register.php">Register</a>
