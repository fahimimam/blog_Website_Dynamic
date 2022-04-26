<?php

$host = 'localhost';
$user = 'root';
$pass = 'language';

$db_name = 'blog';

$conn = new MySQLi($host, $user, $pass, $db_name);

if($conn->connect_error){
    die('Database coneection error: ' . $conn->connect_error);
}
