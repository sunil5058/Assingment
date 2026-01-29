<?php

$server = "localhost";
$username = "root"; 
$password = "";
$database = "blogpostdb";


//create a connection
$conn = new mysqli ($server, $username, $password, $database);


//check connection
if (!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

?>