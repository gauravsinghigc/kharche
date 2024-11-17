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

  <title>Change Password @ <?php echo APP_NAME; ?></title>
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
          <?php if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $for = SECURE($_GET['for'], "d");
            $CheckTokenisations = CHECK("SELECT * FROM user_password_change_requests where PasswordChangeToken='$token' and PasswordChangeRequestStatus='Active'");
            if ($CheckTokenisations == null) { ?>
              <div class="p-2">
                <h4 class="mb-3 text-center"><span class="text-warning">OOoopsss...</span></h4>
                <h5 class="text-center">Invalid Token Received</h5>
                <a href="<?php echo DOMAIN; ?>/auth/" class="btn btn-primary btn-sign"><i class="fa fa-angle-left"></i> Back to Login Page</a>
              </div>
              <?php } else {
              $ValidateTokenForUser = CHECK("SELECT * FROM user_password_change_requests where PasswordChangeToken='$token' and UserIdForPasswordChange='$for' and PasswordChangeRequestStatus='Active'");
              if ($ValidateTokenForUser == null) { ?>
                <div class="p-2">
                  <h4 class="mb-3 text-center"><span class="text-warning">OOoopsss...</span></h4>
                  <h5 class="text-center">Invalid Token Access Found!</h5>
                  <a href="<?php echo DOMAIN; ?>/auth/" class="btn btn-primary btn-sign"><i class="fa fa-angle-left"></i> Back to Login Page</a>
                </div>
              <?php } else {
                $_SESSION['REQUESTED_EMAIL_ID'] = $for;
                $_SESSION['PASSWORD_RESET_TOKEN'] = $token;
                $data = array(
                  "PasswordChangeRequestStatus" => "Expired",
                );
                $Update = UPDATE_TABLE("user_password_change_requests", $data, "PasswordChangeToken='$token'"); ?>
                <div>
                  <form action="<?php echo CONTROLLER('AuthController/AuthController.php'); ?>" method="POST">
                    <?php FormPrimaryInputs(true); ?>
                    <p class="bg-success text-white p-2 rounded-2"><i class="fa fa-check"></i> Account verified Successfully!</p>
                    <div class="form-group mb-3">
                      <label>Enter New Password</label>
                      <input type="password" name="Password1" class="form-control" placeholder="***********" required>
                    </div>
                    <div class="form-group mb-4">
                      <label>Re-Enter Password</label>
                      <input type="password" name="Password2" class="form-control" placeholder="***********" required>
                    </div>
                    <div class="flex-s-b mt-3">
                      <button type="submit" class="btn btn-primary btn-sign" name="RequestForPasswordChange"><i class="fa fa-power-off on"></i> Change Password</button>
                    </div>
                  </form>
                </div>
            <?php }
            }
          } else { ?>
            <div class="p-2">
              <h3 class="mb-3 text-center"><i class="fa fa-warning text-warning"></i> No Access Token Found!</h3>
              <a href="<?php echo DOMAIN; ?>/auth/" class="btn btn-primary btn-sign"><i class="fa fa-angle-left"></i> Back to Login Page</a>
            </div>
          <?php } ?>
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