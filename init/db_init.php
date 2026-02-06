<?php 

$host = 'localhost';
$dbName = 'g18bcsy3';
$db_user = 'root';
$pass = '';
$port = '3306';

// createa db

$db = new mysqli($host,$db_user,$pass,$dbName,$port);

if($db->connect_error){
    die("Connection failed: " . $db->connect_error);
}

?>