<?php

session_start();
session_destroy();
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");

}
else{
    echo "Welcome to the Dashboard, " . $_SESSION['user_name'] . "! You are logged in as " . $_SESSION['user_role'] . ". <a href='logout.php'>Logout</a>" ;
}



?>