<?php

$servername = "localhost";
$username = "phpmyadmin";
$password = "root";
$database_name = "form";

try{
    $conn = new mysqli($servername, $username, $password, $database_name);

    if($conn->connect_error) {
        throw new Exception(die ('Database connection failed ' . $conn->connect_error));
    }
} catch (Exception $e) {
    echo $e->getMessage();
}


?>