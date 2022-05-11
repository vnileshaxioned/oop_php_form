<?php

$servername = "localhost";
$username = "phpmyadmin";
$password = "root";
$database_name = "user";

$connection = new mysqli($servername, $username, $password, $database_name);

if($connection->connect_error) {
    die ('Database connection failed ' . $connection->connect_error);
}

?>