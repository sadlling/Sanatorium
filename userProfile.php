<?php
session_start();
include "backend/displayingData.php";

$user = null;

if ($_SESSION['id_user'] != null) {
  $user = GetUserByID($_SESSION['id_user']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="styles/userProfileStyles.css" />
  <title>Профиль</title>
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
        <form action="backend/userProfileHandler.php" method="get">
          <button type="submit" name="leave" class="d-inline btn btn-outline-danger me-2" value="out">
            Выйти
          </button>
        </form>
      </div>
    </div>
  </header>
  <p class="fs-1 text-center">Профиль пользователя</p>
  <div class="container">
    <div class="row gutters">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12" style="height: 44vh">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <div class="account-settings">
              <div class="user-profile">
                <div class="user-avatar">
                  <img src="images/user.png" alt="Maxwell Admin" />
                </div>
                <h5 class="user-name"><?= $user['name'] . ' ' . $user['surname'] ?></h5>
                <h6 class="user-email"><?= $user['email'] ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
        <div class="card h-100 shadow-sm">
          <p class="fs-4 text-center">Активные бронирования</p>
          <form action="backend/userProfileHandler.php" method="get">
            <div class="card-body">
              <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <?php
                if (empty(GetBookingByUserID($_SESSION['id_user']))) {
                  echo "<div class = 'container' name = 'notFound'>";
                  echo ("<p class='text-center fs-3' style='margin-top: 100px; color: gray;'>Нет активных бронирований</p>");
                  echo "</div>";
                } else {
                  foreach (GetBookingByUserID($_SESSION['id_user']) as $row) {
                    $vouchers  = GetVoucherByID($row['idVoucher']);
                ?>
                    <!-- StartCard -->
                    <div class="col mb-3">
                      <div class=" card  shadow-sm">
                        <img src=" images/<?= $vouchers['image'] ?>" alt="" style="height: 150px; border-radius: 2%" />
                        <div class="card-body">
                          <p class="card-text"><?= $vouchers['title'] ?></p>
                          <p class="card-text">
                            <?php
                            $date = new DateTime($row['startDate']);
                            $date->add(new DateInterval("P{$vouchers['duration']}D"));
                            echo date('d-m-Y', strtotime($row['startDate'])) . ' - ' . $date->format('d-m-Y');
                            ?>
                          </p>
                          <p class="card-text"><?= $row['totalCost'] ?></p>
                          <div class="d-flex justify-content-end align-items-center">
                            <div class="btn-group">
                              <button type="submit" name="cancelBooking" class="btn btn-sm btn-outline-danger" value="<?= $row['id'] ?>">
                                Отменить
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                <?php }
                } ?>
                <!-- End Card -->
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Успешно</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= $_SESSION['success'] ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="d-inline btn btn-outline-dark" data-bs-dismiss="modal">Закрыть</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
  <?php
  if ($_SESSION['success'] != null) {
  ?>
    <script>
      const modal = new bootstrap.Modal("#exampleModal")
      window.addEventListener('DOMContentLoaded', () => {
        modal.show();
      });
    </script>
  <?php
    unset($_SESSION['success']);
  } ?>
</body>

</html>