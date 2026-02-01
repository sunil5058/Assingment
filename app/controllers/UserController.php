<?php
require_once '../config/db.php';
require_once '../app/models/User.php';

class UserController {
    private $user;
    public function __construct($pdo){ $this->user = new User($pdo); }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name = htmlspecialchars($_POST['name']);
            $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
            $password = htmlspecialchars($_POST['password']);

            if($name && $email && $password){
                $success = $this->user->register($name,$email,$password);
                if($success) header("Location: ../public/index.php");
                else $error = "Email already registered!";
            } else { $error = "Invalid input!"; }
        }
        require '../app/views/register.php';
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
            $password = htmlspecialchars($_POST['password']);
            if($email && $password){
                $user = $this->user->login($email,$password);
                if($user){
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_role'] = $user['user_role'];
                    header("Location: dashboard.php");
                } else $error = "Invalid credentials!";
            } else $error = "Invalid input!";
        }
        require '../app/views/login.php';
    }

    public function logout(){
        session_start();
        session_destroy();
        header("Location: ../public/index.php");
    }
}
?>
