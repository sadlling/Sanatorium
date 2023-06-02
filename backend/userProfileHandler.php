<?php
session_start();
include "connection.php";

if ($_GET['leave'] == 'out') {
    unset($_SESSION['id_user']);
    header("Location:../index.php");
} else {

    try {


        global $conn;

        // Количество путевок по айдишнику бронирования
        $stmt = $conn->prepare("Select  vouchers.amount,booking.idVoucher from booking inner join vouchers  ON booking.idVoucher = vouchers.id  where booking.id = :id ");
        $stmt->execute(array(':id' => $_GET['cancelBooking']));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //Обновление количества
        $new_amount = $results[0]['amount'] + 1;
        $stmt = $conn->prepare("UPDATE sanatorium.vouchers SET amount = :new_amount WHERE id = :voucher_id");
        $stmt->execute(array(':new_amount' => $new_amount, 'voucher_id' => $results[0]['idVoucher']));
        //Удаление бронирования по айдишнику
        $stmt = $conn->prepare("DELETE FROM sanatorium.booking WHERE id = :id");
        $stmt->execute(array(':id' => $_GET['cancelBooking']));
    } catch (PDOException $e) {
        echo 'Failed ' . $e->getMessage();
        exit();
    }
    $_SESSION['success'] = 'Бронирование успешно отменено!';
    header("Location:../userProfile.php");
}
