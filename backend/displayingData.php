<?php
include "connection.php";
// Все данные о докторах
function GetAllDoctors()
{
    try {
        global $conn;
        $stmt = $conn->query("select * from doctors");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}
//Доктор по айдишнику
function GetDoctorByID($id)
{
    try {
        global $conn;
        $stmt = $conn->prepare("select *from doctors where id =:id");
        $stmt->execute(array(':id' => $id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results[0];
}
// Должности врачей без повторений
function GetPositionsDoctors()
{
    try {
        global $conn;
        $stmt = $conn->query("select distinct position from doctors");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}
// Категории врачей без повторений
function GetCategorysDoctors()
{
    try {
        global $conn;
        $stmt = $conn->query("select distinct category from doctors");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}
// Все данные о комнатах
function GetAllRooms()
{
    try {
        global $conn;
        $stmt = $conn->query("select * from rooms");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}

//тип и вместимость комнат
function GetTypeAndCapacityRooms()
{
    try {
        global $conn;
        $stmt = $conn->query("select distinct type,capacity from rooms");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}
// Все данные об услугах
function GetAllServices()
{
    try {
        global $conn;
        $stmt = $conn->query("select * from services");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}
// Данные об услуге по айдишнику
function GetServiceByID($id)
{
    try {
        global $conn;
        $stmt = $conn->prepare("select *from services where id =:id");
        $stmt->execute(array(':id' => $id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results[0];
}

// Все данные о путевках
function GetAllVouchers()
{
    try {
        global $conn;
        $stmt = $conn->query("select *from vouchers");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}



//Информация о пользователе по айдишнику
function GetUserByID($id)
{
    try {
        global $conn;
        $stmt = $conn->prepare("select *from user where id =:id");
        $stmt->execute(array(':id' => $id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results[0];
}
//Вся информация о бронировании по айдишнику пользователя
function GetBookingByUserID($idUser)
{
    try {
        global $conn;
        $stmt = $conn->prepare("select *from booking where idUser =:idUser");
        $stmt->execute(array(':idUser' => $idUser));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}
//Вся информация о путевки по айдишнику
function GetVoucherByID($id)
{
    try {
        global $conn;
        $stmt = $conn->prepare("select *from vouchers where id =:id");
        $stmt->execute(array(':id' => $id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results[0];
}

//Вся информация о путевки по айдишнику
function GetVouchersServicesByID($id)
{
    try {
        global $conn;
        $stmt = $conn->prepare("select *from vouchersservices where idVoucher =:id");
        $stmt->execute(array(':id' => $id));
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}


// foreach (GetAllRooms() as $row) {
//     echo $row['type'];
// }
