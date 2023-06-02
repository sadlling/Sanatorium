<?php
session_start();
include "connection.php";


try {
    global $conn;

    $stmt = $conn->prepare("select *from user where name = :name and password =:password");
    $stmt->execute(array(':name' => $_POST['name'], ':password' => $_POST['pass']));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
        // if ($_SESSION['id_user'] != null) {
        //     unset($_SESSION['id_user']);
        // } else {
        $_SESSION['id_user'] = $results[0]['id'];
        header("Location:../index.php");
    } else {

        $_SESSION['error'] = "Неверный логин или пароль!";
        header("Location:../autorization.php");
    }
} catch (PDOException $e) {

    echo 'Failed to get data from database: ' . $e->getMessage();
    exit();
}
