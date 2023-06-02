<?php
session_start();
include "backend/displayingData.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="styles/indexStyles.css" />
  <title>Санаторий-профилакторий</title>
</head>

<body>
  <header class="p-3 text-bg-dark" style="position: fixed; width: 100vw">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none"></a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li>
            <a href="doctors.php" class="nav-link px-2 text-white">Врачи</a>
          </li>
          <li>
            <a href="services.php" class="nav-link px-2 text-white">Услуги</a>
          </li>
          <li>
            <a href="rooms.php" class="nav-link px-2 text-white">Номера</a>
          </li>
          <li>
            <a href="vouchers.php" class="nav-link px-2 text-white">Бронирование</a>
          </li>
        </ul>

        <div class="text-end">
          <?php if ($_SESSION['id_user'] != null) {
            $user = GetUserByID($_SESSION['id_user']);
          ?>
            <a href="userProfile.php" class="nav-link text-center fs-5 mb-0"><?= $user['name'] . ' ' . $user['surname'] ?></a>
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
  <main class="container-fluid g-0">
    <div style="height: 80vh">
      <div class="parallax-img"></div>
    </div>
    <div>
      <div class="container">
        <p class="text-center fs-1">О нас</p>
        <p class="text-center fs-5">
          Санаторий «Здравница» — известная здравница, расположенная в самом
          сердце Беларуси. Санаторий окружен потрясающим природным ландшафтом,
          свежим воздухом и источниками минеральной воды. Санаторий
          «Здравница» славится высококачественными медицинскими услугами,
          которые предоставляет команда опытных и квалифицированных врачей и
          терапевтов. Санаторий предлагает широкий спектр лечебных процедур,
          таких как бальнеотерапия, физиотерапия, грязелечение, массаж и
          другие. Удобства санатория созданы для комфорта и отдыха гостей.
          Номера просторные, хорошо оборудованные и оснащены современными
          удобствами, обеспечивающими приятное и комфортное пребывание. В
          санатории также есть ресторан, где подают полезные и вкусные блюда,
          приготовленные из местных продуктов. Гости санатория "Здравница"
          также могут заняться различными видами досуга, такими как пешие
          походы, верховая езда и катание на лыжах. Санаторий расположен
          недалеко от нескольких горнолыжных курортов и туристических троп,
          что делает его идеальным местом для любителей активного отдыха. В
          целом, санаторий «Здравница» — идеальное место, чтобы расслабиться,
          набраться сил и оздоровиться. Его красивая природа,
          высококачественные медицинские услуги и комфортабельные условия
          делают его отличным выбором для тех, кто хочет избежать стрессов
          современной жизни и насладиться расслабляющим и омолаживающим
          отдыхом.
        </p>
      </div>
      <div class="container text-center">
        <p class="text-center fs-1">Преимущества нашего санатория</p>
        <div class="d-flex justify-content-evenly flex-wrap fs-5">
          <div class="advantages">
            <img src="images/index-benefits.svg" alt="Сертификат" />
            <p>Все возможные сертефикаты</p>
          </div>
          <div class="advantages">
            <img src="images/index-benefits2.svg" alt="Врачи" />
            <p>5000 врачей высшей категории</p>
          </div>
          <div class="advantages">
            <img src="images/index-benefits3.svg" alt="Обслуживание" />
            <p>Лучшие медицинские услуги</p>
          </div>
          <div class="advantages">
            <img src="images/index-benefits4.svg" alt="Питание" />
            <p>Еда как в лучших столовы</p>
          </div>
        </div>
      </div>
      <div class="text-center mt-5 mb-3">
        <a href="vouchers.php" class="btn btn-outline-success btn-lg">Забронировать путевку!</a>
      </div>
    </div>
    <div class="wrapper">
      <div class="parallax-img"></div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</body>

</html>