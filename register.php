<?php
if(isset($_POST['submit'])){
    include 'db.php';
    session_start();

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    $result = mysqli_query($conn, $sql);
    if(!$result){
        echo "Error: ". mysqli_error($conn);
    }else{
        echo "Registration successful!";
    }
        

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="register.php" method="post">
        Name : <input type="text" name="name" required><br>
        Email : <input type="email" name="email" required><br>
        Password : <input type="password" name="password" required><br>
        Role:
        <select name="role" id="">
        <option value="subscriber">Subscriber</option>
        <option value="author">Author</option>
        </select><br>
        <input type="submit" name="submit" value="Register">
    </form>

        
    
</body>
</html>