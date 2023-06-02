<?php
session_start();
include "backend/displayingData.php";
include "backend/filters.php";
if ($_GET['id'] != null) {
    $service = GetServiceByID($_GET['id']);
    $doctor = GetDoctorByID($service['idDoctor']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                <img src="images/<?= $service['image'] ?>" class="d-block mx-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">

            </div>
            <div class="col-lg-6">

                <h1 class="display-5 fw-bold lh-1 mb-3"><?= $service['name'] ?></h1>
                <p class="lead fs-4 fw-normal"><?= $service['decription'] ?></p>
                <p class="lead fs-4 fw-normal">Стоимость: <?= $service['cost'] ?> </p>
                <p class="lead fs-4 fw-normal">Врач: <?= $doctor['name'] . ' ' . $doctor['surname'] . ' , ' . $doctor['position'] ?></p>

            </div>

        </div>
        <a href="services.php" class="btn btn-success mt-5 " style="width: 100px;">Назад</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>