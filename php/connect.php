<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$user = 'root';
$password = 'root';
$db = 'shopper';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
$success = mysqli_real_connect(
	$link, 
	$host, 
	$user, 
	$password, 
	$db,
	$port
);
?>