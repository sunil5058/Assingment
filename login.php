<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['user_role']; // 'admin' or 'user'
        $_SESSION['user_name'] = $user['name'];

        // Redirect based on role
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
