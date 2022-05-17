<?php


$host = "localhost";
$user = "root";
$password = "";
$database = "test";
// $con = mysqli_connect($host, $user, $password, $database) or die('connection failed');

$con = mysqli_connect('localhost', 'root', 'test') or die('connection failed');

$con_db = mysqli_connect('localhost', 'root', 'manage_account') or die('connection failed');
$my_email = "1901040060@S.hanu.edu.vn";
$link_reset = "http://localhost:3000/login.php";

?>