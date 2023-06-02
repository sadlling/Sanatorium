<?php
session_start();
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
  <title>Услуги</title>
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

        <form action="services.php" method="GET" class="d-flex justify-content-evenly mb-3 mb-lg-0 mb-md-0 me-lg-3">
          <input type="search" name="name" class="form-control form-control-dark me-3" placeholder="Поиск процедуры..." />
          <button type="submit" name="Search" class="d-inline btn btn-outline-light me-2">
            Поиск
          </button>
        </form>
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
      <p class="fs-2">Подобрать услугу</p>
      <form action="services.php" method="get" class="d-flex flex-wrap justify-content-start">
        <select name="sort" class="form-select w-25 me-3" aria-label="Default select example">
          <option selected>Параметры сортировки</option>
          <option value="asc">По возрастанию цены</option>
          <option value="desc">По убыванию цены</option>
        </select>
        <button type="submit" class="d-inline btn btn-outline-dark me-2">
          Отсортировать
        </button>
        <button type="submit" name="clearFilters" class="d-inline btn btn-outline-dark">
          Очистить
        </button>
      </form>
    </section>
    <div class="album py-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
          <!-- Start card -->
          <?php
          $services = [];
          if (isset($_GET['clearFilters'])) {
            $services = GetAllServices();
          } else {
            if (isset($_GET['sort'])) {
              $services = SortingServices($_GET['sort']);
            } else {
              if (isset($_GET['Search'])) {
                if ($_GET['name'] != "") {
                  $services = GetServicesByName($_GET['name']);
                  if (empty($services)) {

                    echo "<div class = 'container' name = 'notFound'>";
                    echo ("<p class='text-center fs-3' style='margin-top: 200px; color: gray;'>По вашему запросу ничего не найдено</p>");
                    echo "</div>";
                  }
                } else
                  $services = GetAllServices();
              } else {
                $services = GetAllServices();
              }
            }
          }
          foreach ($services as $row) {
          ?>
            <div class="col">
              <div class="card shadow-sm mb-4">
                <img src="images/<?= $row['image'] ?>" alt="" style="height: 250px" />
                <div class="card-body">
                  <p class="card-text mb-2"><?= $row['name'] ?></p>
                  <p class="card-text mb-2"><?= $row['cost'] ?> BYN</p>
                  <div class="d-flex justify-content-end align-items-center">
                    <div class="btn-group">
                      <a href="aboutService.php?id=<?= urlencode($row['id']) ?>" class="btn btn-sm btn-outline-secondary">
                        Подробнее
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- End card -->
          <?php
          }
          ?>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>