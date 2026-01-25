<?php 

$host = 'localhost';
$dbName = 'g18bcsy3';
$user = 'root';
$pass = '';
$port = '3306';

// createa db

$db = new mysqli($host,$user,$pass,$dbName,$port);

if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}


?>