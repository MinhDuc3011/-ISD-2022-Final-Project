<?php

$db_name = 'mysql:host=localhost;dbname=shop_db';
$user_name = 'root';
$user_password = '';

$conn = new PDO($db_name, $user_name, $user_password);

$con_db = mysqli_connect('localhost', 'root', 'manage_account') or die('connection failed');
$my_email = "1901040060@S.hanu.edu.vn";
$link_reset = "http://localhost:3000/login.php";

?>