<?php

$server = "localhost";
$username = "root"; 
$password = "";
$database = "blogpostdb";


//create a connection
$conn = new mysqli ($server, $username, $password, $database);


//check connection
if (!$conn){
    echo "error!:{$conn->connect_error}";
}else{
    echo "Connection successful";
}

?>