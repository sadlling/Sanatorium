<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="styles/registrationStyles.css" />

  <title>Авторизация</title>
</head>

<body>
  <div class="container mt-5">
    <div class="signin-content">
      <div class="signin-image">
        <figure>
          <img src="images/autorization.jpg" alt="sing up image" />
        </figure>
        <a href="registration.php" class="signup-image-link">Нет аккаунта? Зарегестрируйтесь!</a>
      </div>
      <div class="signin-form">
        <h2 class="form-title">Авторизация</h2>
        <form method="POST" action="backend/autorizationHandler.php" class="register-form" id="login-form">
          <div class="form-group">
            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
            <input type="text" name="name" id="name" placeholder="Ваше имя" />
          </div>
          <div class="form-group">
            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
            <input type="text" name="pass" id="pass" placeholder="Пароль" />
          </div>
          <div class="form-group">
          </div>
          <div class="form-group form-button">
            <input type="submit" name="signin" id="signin" class="d-inline btn btn-outline-dark" value="Авторизоваться" />
          </div>
        </form>

      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ошибка</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?= $_SESSION['error'] ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="d-inline btn btn-outline-dark" data-bs-dismiss="modal">Закрыть</button>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <?php
  if ($_SESSION['error'] != null) {
  ?>
    <script>
      const modal = new bootstrap.Modal("#exampleModal")
      window.addEventListener('DOMContentLoaded', () => {
        modal.show();
      });
    </script>
  <?php
    unset($_SESSION['error']);
  } ?>
</body>

</html>