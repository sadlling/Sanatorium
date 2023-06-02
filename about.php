<?php
session_start();
include "backend/displayingData.php";
include "backend/filters.php";
if ($_GET['id'] != null) {
  $voucher = GetVoucherByID($_GET['id']);
  $vouchersServices = GetVouchersServicesByID($_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>О путевке</title>
  <style>
    body {
      font-family: "Montserrat", sans-serif;
    }

    .list-group-item.active,
    .list-group-item.active:hover {
      background-color: lightgray !important;
      border-color: lightgray !important;
      color: black;
      border-radius: 0.3rem;
    }
  </style>
</head>

<body>

  <header class="p-3 bg-dark text-white">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap"></use>
          </svg>
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="index.php" class="nav-link px-2 text-white">На главную</a></li>
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
  <div class="container ">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5 justify-content-center">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="images/<?= $voucher['image'] ?>" class="d-block mx-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3"><?= $voucher['title'] ?></h1>
        <p class="lead fs-4 fw-normal"><?= $voucher['description'] ?></p>
        <p class="lead fs-4 fw-normal">Стоимость: <?= $voucher['cost'] ?> byn</p>
        <p class="lead fs-4 fw-normal">Продолжительность: <?= $voucher['duration'] ?> дней</p>
        <p class="lead fs-4 fw-normal" id="amountVouchers">Осталось путевок: <?= $voucher['amount'] ?> </p>

      </div>
    </div>
  </div>
  <div class="container">
    <p class="fs-4 fw-bold">Перечень процедур</p>
  </div>
  <div class="container  ">
    <div class="row">
      <div class="col-6">
        <div class="list-group list-group-flush" id="list-tab" role="tablist">
          <?php
          foreach ($vouchersServices as $row) {
            $service = GetServiceByID($row['idService']);
          ?>
            <a class="list-group-item list-group-item-action " id="list-<?= $service['id'] ?>-list" data-bs-toggle="list" href="#list-<?= $service['id'] ?>" role="tab" aria-controls="list-home"><?= $service['name'] ?></a>
          <?php } ?>
        </div>
      </div>
      <div class="col-6">
        <div class="tab-content" id="nav-tabContent">

          <?php
          foreach ($vouchersServices as $row) {
            $service = GetServiceByID($row['idService']);
            $doctor = GetDoctorByID($service['idDoctor']);
          ?>
            <div class="tab-pane fade" id="list-<?= $service['id'] ?>" role="tabpanel">
              <p><?= $service['decription'] ?></p>
              <p><?= $doctor['name'] . ' ' . $doctor['surname'] . ' , ' . $doctor['position'] ?></p>
            </div>
          <?php
          } ?>
        </div>
      </div>
    </div>

    <?php if ($_SESSION['id_user'] != null) { ?>
      <div class="d-grid gap-2 d-md-flex justify-content-center mt-5">
        <form action="backend/bookingHandler.php" method="GET" id="getBooking">
          <label for="startDate" class="form-label">Выберите дату заезда</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" id="idVoucher" name="idVoucher" value="<?= $voucher['id'] ?>" hidden>
            <input type="text" class="form-control" id="costVoucher" name="costVoucher" value="<?= $voucher['cost'] ?>" hidden>
            <input type="date" class="form-control" id="startDate" name="startDate">
          </div>
          <button type="button" id="booking" class="btn btn-success btn-lg px-4 me-md-2">Забронировать</button>
          <a href="vouchers.php" class="btn btn btn-outline-dark btn-lg px-4">Назад</a>
        </form>
      </div>
  </div>
<?php
    } else { ?>
  <div class='container' name='notFound'>
    <p class='text-center fs-3' style='margin-top: 20px; color: gray;'>Для того, чтобы забронировать путевку,<br> войдите или зарегистрируйтесь</p>
  </div>
<?php
    } ?>
<div class="position-fixed top-0 start-0 p-3">
  <div id="success-notification" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body fs-5">
        Путевка успешно забронирована!
      </div>
      <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="scripts/bookingHandler.js"></script>
</body>

</html>