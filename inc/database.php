<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'cafe';

$conn= mysqli_connect('localhost','root','','cafe');

if(mysqli_connect_errno()){
    die('Database Conection fsiled'.mysqli_connect_error());
}  
?>
