<?php
session_start();
include "backend/connection.php";
include "backend/displayingData.php";
include "backend/filters.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: "Montserrat", sans-serif;
    }
  </style>
  <title>Номера</title>
</head>

<body>
  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li>
            <a href="index.php" class="nav-link px-2 text-white">На главную</a>
          </li>
        </ul>
        <!-- <form class="d-flex justify-content-evenly mb-3 mb-lg-0 me-lg-3">
          <input type="search" class="form-control form-control-dark me-3" placeholder="Search..." aria-label="Search" />
          <button type="button" class="d-inline btn btn-outline-light me-2">
            Search
          </button>
        </form> -->
        <div class="text-end">
          <?php if ($_SESSION['id_user'] != null) {
            $user = GetUserByID($_SESSION['id_user']);
          ?>
            <a href="userProfile.php" class="text-white nav-link text-center fs-5 mb-0"><?= $user['name'] . ' ' . $user['surname'] ?></a>
          <?php
          } else {
          ?>
            <a href="autorization.php" class="btn btn-outline-light me-2">
              Авторизация
            </a>
            <a href="registration.php" class="btn btn-success ">Регистрация</a>
          <?php
          } ?>
        </div>
      </div>
    </div>
  </header>
  <main>
    <section class="container mt-5">
      <p class="fs-2">Подобрать номер</p>
      <form action="rooms.php" method="POST" class="d-flex flex-wrap justify-content-between">
        <select name="type" class="form-select w-25 me-3" aria-label="Default select example">
          <option value="" selected>Количество мест</option>
          <?php
          foreach (GetTypeAndCapacityRooms() as $row) { ?>
            <option value=<?= $row['type'] ?>><?= $row['type'] ?></option>
          <?php
          } ?>
        </select>
        <select name="startCost" class="form-select w-25 me-3" aria-label="Default select example">
          <option value="" selected>Цена от</option>
          <?php
          foreach (GetAllRooms() as $row) { ?>
            <option value=<?= $row['cost'] ?>><?= $row['cost'] ?></option>
          <?php
          } ?>
        </select>
        <select name="endCost" class="form-select w-25 me-3" aria-label="Default select example">
          <option value="" selected>Цена до</option>
          <?php
          foreach (GetAllRooms() as $row) { ?>
            <option value=<?= $row['cost'] ?>><?= $row['cost'] ?></option>
          <?php
          } ?>
        </select>
        <button type="submit" class="d-inline btn btn-outline-dark">
          Подобрать
        </button>
        <button type="submit" name="clearFilters" class="d-inline btn btn-outline-dark">
          Очистить
        </button>
      </form>
    </section>
    <div class="album py-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
          <!-- Start one card -->
          <?php
          $rooms = [];
          if ($_POST != null) {
            if (isset($_POST['clearFilters'])) {
              $rooms = GetAllRooms();
            } else {
              $rooms = GetRoomsByTypeAndCost($_POST['type'], $_POST['startCost'], $_POST['endCost']);
              if (empty($rooms)) {
                echo "<div class = 'container' name = 'notFound'>";
                echo ("<p class='text-center fs-3' style='margin-top: 200px; color: gray;'>По вашему запросу ничего не найдено</p>");
                echo "</div>";
              }
            }
          } else {
            $rooms = GetAllRooms();
          }
          foreach ($rooms as $row) {
          ?>
            <div class="col">
              <div class="card shadow-sm mb-4" style="min-height: 450px;">
                <img src="images/<?= $row['image'] ?>" alt="" style="height: 250px" />
                <div class="card-body">
                  <p class="card-text mb-1"><?= $row['type'] ?></p>
                  <p class="card-text mb-1"><?= $row['description'] ?></p>
                  <p class="card-text mb-1">Стоимость: <?= $row['cost'] ?> рублей в сутки</p>
                  <div class="d-flex justify-content-end align-items-center">
                    <div class="btn-group">

                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php }
          ?>
          <!-- End card -->
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>