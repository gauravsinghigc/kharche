<?php
$Dir = "../..";
require $Dir . "/acm/SysFileAutoLoader.php";


if (isset($_COOKIE['APP_LOGIN_USER_ID'])) {
  $_SESSION['APP_LOGIN_USER_ID'] = $_COOKIE['APP_LOGIN_USER_ID'];
}

if (isset($_SESSION['APP_LOGIN_USER_ID'])) {
  setcookie("APP_LOGIN_USER_ID", $UserId, time() + 60 * 60 * 365);
  header("location:" . DOMAIN . "/app");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Meta -->
  <meta name="description" content="">
  <meta name="author" content="<?php echo APP_NAME; ?>">

  <title>Login @ <?php echo APP_NAME; ?></title>
  <?php include $Dir . "/assets/HeaderFiles.php"; ?>
</head>

<body class="page-sign d-block py-0" style="background-image:url('<?php echo LOGIN_BG_IMAGE; ?>') !important;background-size:cover;background-repeat:no-repeat;">

  <div class="row g-0">
    <div class="col-md-7 col-lg-5 col-xl-4 col-wrapper">
      <div class="card card-sign">
        <div class="card-header">
          <a href="<?php echo DOMAIN; ?>" class="header-logo mb-4">
            <img src="<?php echo APP_LOGO; ?>" class='img-fluid w-50'>
          </a>
          <h3 class="card-title">Sign In</h3>
          <p class="card-text">Welcome back! Please signin to continue.</p>
        </div><!-- card-header -->
        <div class="card-body">
          <form action="<?php echo CONTROLLER; ?>/AuthController/AuthController.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input type="text" name="UserPhoneNumber" class="form-control form-control-lg" placeholder="+91">
            </div>
            <div class="mb-4">
              <label class="form-label d-flex justify-content-between">
                <span class="w-50">Password</span>
                <a href="<?php echo DOMAIN; ?>/auth/forget" class="w-50 text-right">Forgot password?</a>
              </label>
              <input type="password" name="UserPassword" class="form-control form-control-lg" placeholder="********">
            </div>
            <button type="submit" name="LoginRequest" class="btn btn-primary btn-sign">Sign In</button>
          </form>
        </div><!-- card-body -->
        <div class="card-footer justify-content-around">
          Don't have an account? <a href="<?php echo ROOT; ?>/auth/signup/">Create an Account</a>
          <div class="divider">
          </div>
          <?php include $Dir . "/include/others/AuthFooter.php"; ?>
        </div><!-- card-footer -->
      </div><!-- card -->
    </div><!-- col -->
  </div><!-- row -->

  <?php
  include $Dir . "/assets/FooterFiles.php"; ?>
</body>

</html>