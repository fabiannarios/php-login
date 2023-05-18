<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'pasantes';

try {
	$conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
} catch (PDOException $e) {
	die('conexión fallida: '.$e->getMessage());
	
}


?>