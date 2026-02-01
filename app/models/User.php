<?php
class User {
    private $pdo;
    public function __construct($pdo) { $this->pdo = $pdo; }

    public function register($name, $email, $password){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email");
        $stmt->execute(['email'=>$email]);
        if($stmt->rowCount() > 0) return false;

        $stmt = $this->pdo->prepare("INSERT INTO users (name,email,password) VALUES (:name,:email,:password)");
        $stmt->execute(['name'=>$name, 'email'=>$email, 'password'=>$password]);
        return true;
    }

    public function login($email,$password){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email=:email AND password=:password");
        $stmt->execute(['email'=>$email,'password'=>$password]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
