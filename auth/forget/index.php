<?php
$Dir = "../..";
require $Dir . "/acm/SysFileAutoLoader.php";
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

  <title>Forget Password @ <?php echo APP_NAME; ?></title>
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
          <h3 class="card-title">Forget Password</h3>
          <p class="card-text">forget password? don't worry we can help you to recover it.</p>
        </div><!-- card-header -->
        <div class="card-body">
          <form action="<?php echo CONTROLLER; ?>/AuthController/AuthController.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <div class=" mb-3">
              <p>Enter registered phone number and password reset link will be sent on linked email-id.</p>
              <label class="form-label">Enter Phone Number</label>
              <input type="text" name="UserPhoneNumber" class="form-control" placeholder="+91">
            </div>
            <button type="submit" name="SearchAccountForPasswordReset" class="btn btn-primary btn-sign">Search Account</button>
          </form>
        </div><!-- card-body -->
        <div class="card-footer justify-content-around">
          Already have an account? <a href="<?php echo ROOT; ?>/auth/login/">Login Now</a>
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