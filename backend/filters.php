<?php
include "connection.php";

//Данные о комнатах с выбранным количеством мест и ценой в диапазоне
function GetRoomsByTypeAndCost($type, $startCost, $endCost)
{
    try {
        global $conn;
        $sql = "SELECT * FROM rooms";
        if (!empty($type) && !empty($startCost) && !empty($endCost)) {
            $sql .= " WHERE type = :type AND cost >= :startCost AND cost < :endCost";
        } else {
            if (!empty($type) || !empty($startCost) || !empty($endCost)) {
                $sql .= " WHERE";
            }
            if (!empty($type)) {
                $sql .= " type = :type";
            }
            if (empty($type) && !empty($startCost)) {
                $sql .= " cost > :startCost";
            }
            if (!empty($startCost)) {
                $sql .= " AND cost >= :startCost";
            }
            if (empty($type) && !empty($endCost) && empty($startCost)) {
                $sql .= " cost < :endCost ";
            }
            if (!empty($type) && empty($startCost) && !empty($endCost)) {
                $sql .= " AND cost < :endCost";
            }
        }
        // if (!empty($endCost)) {
        //     $sql .= " AND cost < :endCost";
        // }
        $stmt = $conn->prepare($sql);
        if (!empty($startCost)) {
            $stmt->bindParam(':startCost', $startCost);
        }
        if (!empty($endCost)) {
            $stmt->bindParam(':endCost', $endCost);
        }
        if (!empty($type)) {
            $stmt->bindParam(':type', $type);
        }
        // $stmt->execute(['type' => $type, 'startCost' => $startCost, 'endCost' => $endCost]);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}

//Врачи по должности и категории
function GetDoctorsByPositionAndCategory($position, $category)
{
    try {
        global $conn;
        $category = $category . "%";
        $sql = "SELECT * FROM doctors";
        if (!empty($position) && !empty($category)) {
            $sql .= " WHERE position = :position AND category like :category";
        } else {
            if (!empty($position) || !empty($category)) {
                $sql .= " WHERE";
            }
            if (!empty($position)) {
                $sql .= " position = :position";
            }
            if (empty($position) && !empty($category)) {
                $sql .= " category like :category";
            }
        }
        $stmt = $conn->prepare($sql);
        if (!empty($position)) {
            $stmt->bindParam(':position', $position);
        }
        if (!empty($category)) {
            $stmt->bindParam(':category', $category);
        }

        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}

function GetDoctorBySurname($surname)
{
    try {
        global $conn;
        $surname = $surname . "%";
        $stmt = $conn->prepare("Select * from doctors where surname like :surname");
        $stmt->execute(['surname' => $surname]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}

function GetServicesByName($name)
{
    try {
        global $conn;
        $name = $name . "%";
        $stmt = $conn->prepare("Select * from services where name like :name");
        $stmt->execute(['name' => $name]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}

function SortingServices($direction)
{

    try {
        global $conn;
        $sql = "Select * from services order by cost";
        if ($direction == 'asc')
            $sql .= ' asc';
        else
            $sql .= ' desc';

        $stmt = $conn->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Failed to get data from database: ' . $e->getMessage();
        exit();
    }
    return $results;
}

// $result = GetDoctorsByPositionAndCategory($_POST['position'], $_POST['category']);
// print_r($_POST['category']);
// print_r($result);

// if (isset($_POST['type']) && isset($_POST['startCost']) && isset($_POST['endCost'])) {

//     $filteredRooms = GetRoomsByTypeAndCost($_POST['type'], $_POST['startCost'], $_POST['endCost']);
//     header("Location:../rooms.php");
// }
