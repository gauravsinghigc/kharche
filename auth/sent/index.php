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

  <title>Link Sent @ <?php echo APP_NAME; ?></title>
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
        </div><!-- card-header -->
        <div class="card-body">
          <h1 class="text-center display-1"><i class="fa fa-check text-success"></i></h1>
          <h4 class='text-center'>Password reset link sent!</h4>
          <p class='text-center text-secondary'>We have sent a password reset link to your registered email-id, you that link to verify your account and change password for account!</p>
          <a href="<?php echo DOMAIN; ?>" class="btn btn-primary btn-sign">Back to Home</a>
        </div><!-- card-body -->
        <div class="card-footer justify-content-around">
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