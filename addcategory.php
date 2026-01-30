<?php
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}else{
    if($_SESSION['user_role'] =='admin'){
        echo "you are  an admin";
        
    }else{
        header("Location: login.php");
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
    <form action="addcategory.php" method="POST">
        <input type="text" name="name" placeholder="Category Name">
        <input type="submit" name="submit" value="Add Category">


    </form>
    
</body>
</html>