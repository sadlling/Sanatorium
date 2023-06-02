<?php
session_start();
include "connection.php";

try {
    global $conn;

    // $stmt = $conn->prepare("select *from user where name = :name and surname = :surname and password =:password");
    // $stmt->execute(array(':name' => $_POST['name'], ':surname' => $_POST['surname'], ':password' => $_POST['pass']));
    // $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // if (empty($results)) {
    $stmt = $conn->prepare("INSERT INTO sanatorium.user (name, surname, birthDate, phoneNumber, email, password) VALUES (:name, :surname, :birthDate, :phoneNumber, :email, :password)");
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':surname' => $_POST['surname'],
        ':birthDate' => $_POST['birthDate'],
        ':phoneNumber' => $_POST['phone'],
        ':email' => $_POST['email'],
        ':password' => $_POST['pass']
    ));

    $stmt = $conn->prepare("select *from user where password =:password");
    $stmt->execute(array(':password' => $_POST['pass']));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        $_SESSION['id_user'] = $row['id'];
    }

    header("Location:../index.php");
} catch (PDOException $e) {
    if ($e->getCode() == 23000) {
        $_SESSION['error'] = "Такой пользователь уже зарегестрирован!";
        header("Location:../registration.php");
    } else
        echo 'Failed to get data from database: ' . $e->getMessage();
    exit();
}
