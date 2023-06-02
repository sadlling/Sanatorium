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
  <title>Путевки</title>
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
      <p class="fs-2">Подобрать путевку</p>
      </form>
    </section>
    <div class="album py-5">
      <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
          <!-- Start card -->
          <?php
          foreach (GetAllVouchers() as $row) {
          ?>
            <div class="col">
              <div class="card shadow-sm mb-3">
                <img src="images/<?= $row['image'] ?>" alt="" style="height: 250px" />
                <div class="card-body">
                  <p class="card-text"><?= $row['title'] ?></p>
                  <p class="card-text">Стоимость: <?= $row['cost'] ?> byn</p>
                  <p class="card-text">Длительность: <?= $row['duration'] ?> дней</p>
                  <p class="card-text">Осталось путевок: <?= $row['amount'] ?></p>
                  <div class="d-flex justify-content-end align-items-center">
                    <div class="btn-group">
                      <a href="about.php?id=<?= urlencode($row['id']) ?>" type="button" class="btn btn-sm btn-outline-secondary">
                        Подробнее
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <!-- End Card -->
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>