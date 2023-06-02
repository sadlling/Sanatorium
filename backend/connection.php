<?php
$host = 'localhost';
$database = 'sanatorium';
$user = 'root';
$password = '121219';


try {
    $conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Failed to connect to database: ' . $e->getMessage();
    exit();
}
