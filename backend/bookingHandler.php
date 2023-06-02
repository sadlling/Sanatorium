<?php
session_start();
include "connection.php";


try {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO sanatorium.booking (idUser, idVoucher, startDate, totalCost) VALUES (:idUser, :idVoucher, :startDate, :totalCost)");
    $stmt->execute(array(
        ':idUser' => $_SESSION['id_user'],
        ':idVoucher' => $_GET['idVoucher'],
        ':startDate' => $_GET['startDate'],
        ':totalCost' => $_GET['costVoucher'],
    ));

    $stmt = $conn->prepare("Select amount from vouchers  WHERE id = :voucher_id");
    $stmt->execute(array(':voucher_id' => $_GET['idVoucher']));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $new_amount = $results[0]['amount'] - 1;
    $stmt = $conn->prepare("UPDATE sanatorium.vouchers SET amount = :new_amount WHERE id = :voucher_id");
    $stmt->execute(array(':new_amount' => $new_amount, 'voucher_id' => $_GET['idVoucher']));

    header("Location:../vouchers.php");
} catch (PDOException $e) {

    echo 'Failed to get data from database: ' . $e->getMessage();
    exit();
}
