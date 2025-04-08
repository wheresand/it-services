<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>IT-SERVICES | Login</title>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>IT</b> SERVICES</a>
    </div>
    
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <!-- Display Error Messages -->
      <?php if (isset($_SESSION['login_error'])): ?>
        <div class="alert alert-danger">
          <?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?>
        </div>
      <?php endif; ?>

      <form action="loginCheck.php" method="post">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12 pt-2 text-center">
            <div class="g-recaptcha" data-sitekey="6Lf1lQ4rAAAAAM60OtGqd_K3p9J1hEB_QyHWDo3f"></div>
          </div>
          <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
        </div>
      </form>

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/dist/js/adminlte.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>
</html>
