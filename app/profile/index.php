<?php
$Dir = "../../";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
$PageName = "Profile";
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

  <title>Profile - <?php echo APP_NAME; ?></title>
  <?php include  $Dir . "assets/HeaderFiles.php"; ?>
  <script>
    window.onload = function() {
      document.getElementById("profile").classList.add("active");
    }
  </script>
</head>

<body>
  <?php
  include $Dir . "include/Sidebar.php";
  include $Dir . "include/Header.php";
  ?>
  <div class="main main-app p-3 p-lg-4">
    <div class="row mt-1">
      <div class="col-md-12">
        <div class="flex-s-b media-profile">
          <div class="media-img mb-3 mb-sm-0">
            <img src="<?php echo AuthAppUser('UserProfileImage'); ?>" class="img-fluid user" alt="...">
            <form class="form m-t-3" action="<?php echo CONTROLLER("ModuleController/UserController.php"); ?>" method="POST" enctype="multipart/form-data">
              <input type="text" name="updateprofileimage" value="<?php echo AuthAppUser("UserId"); ?>" hidden="">
              <input type="text" name="current_img" value="<?php echo SECURE(AuthAppUser("UserProfileImage"), "e"); ?>" hidden="">
              <?php FormPrimaryInputs(true); ?>
              <label for="UploadProfileimg" class="text-center">
                <img src="<?php echo STORAGE_URL_D; ?>/tool-img/img-upload.png" style="margin-top: -2em;" class="w-pr-10 w-25">
              </label>
              <input type="file" class="hidden" onchange="form.submit()" hidden="" name="UserProfileImage" id="UploadProfileimg" value="<?php echo APP_LOGO; ?>" accept="images/*">
            </form>
          </div>
          <div class="media-body">
            <h5 class="media-name"><?php echo AuthAppUser('UserFullName'); ?></h5>
            <p class="d-flex gap-1 mb-2 text-secondary"><i class="ri-information-line"></i> <?php echo GetStrings(AuthAppUser("UserRole")); ?>, <?php echo AuthAppUser('UserDisplayName'); ?></p>
            <p class="mb-0">
              <span><i class='ri-phone-line'></i> <?php echo AuthAppUser('UserPhoneNumber'); ?></span><br>
              <span><i class='ri-mail-line'></i> <?php echo AuthAppUser('UserEmailId'); ?></span><br>
            </p>
          </div>
        </div>
      </div>
      <div class="col-xl mb-3 mt-3">

        <div class="row">
          <div class="col-md-6 mb-3">
            <form class="form" action="<?php echo CONTROLLER("ModuleController/UserController.php"); ?>" method="POST">
              <?php FormPrimaryInputs(
                true,
                [
                  "UserId" => AuthAppUser("UserId"),
                ]
              ) ?>
              <div class="row">
                <div class="col-md-12 col-sm-12 mb-3">
                  <h4 class="app-heading"><i class='fa fa-user'></i> Primary Details</h4>
                </div>
                <?php FormPrimaryInputs(true); ?>
                <div class="form-group col-md-6 col-sm-6 mb-3">
                  <label>Full Name</label>
                  <input type="text" name="UserFullName" value="<?php echo AuthAppUser("UserFullName"); ?>" class="form-control" required="">
                </div>
                <div class="form-group col-md-6 col-sm-6 mb-3">
                  <label>Phone Number</label>
                  <input type="text" name="UserPhoneNumber" value="<?php echo AuthAppUser("UserPhoneNumber"); ?>" class="form-control" readonly='' required="">
                </div>
                <div class="form-group col-md-6 col-sm-6 mb-4">
                  <label>Email Id</label>
                  <input type="email" readonly="" name="UserEmailId" value="<?php echo AuthAppUser("UserEmailId"); ?>" class="form-control" readonly='' required="">
                </div>
                <div class="form-group col-md-6 col-sm-6 mb-4">
                  <label>App Price Type</label>
                  <select name="UserPriceType" class="form-control" required="">
                    <?php InputOptions([
                      "₹", "$", "€", "£", "د.ك"
                    ], AuthAppUser("UserPriceType")); ?>
                  </select>
                </div>
                <br>
                <div class="col-md-12 text-right mt-3">
                  <button type="Submit" name="UpdateProfile" class="btn btn-lg btn-success">Update Details </button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-6 mb-3">
            <form class="form" action="<?php echo CONTROLLER("ModuleController/UserController.php"); ?>" method="POST">
              <?php FormPrimaryInputs(true); ?>
              <div class="row">
                <div class="col-md-12 col-sm-12 mb-3">
                  <h4 class="app-heading"><i class='fa fa-key'></i> Change Password <span id="passmsg"></span></h4>
                </div>
                <div class="form-group col-md-6 col-sm-6 mb-3">
                  <label>Enter New Password</label>
                  <input type="password" name="UserPassword" oninput="checkpass()" id="pass1" class="form-control" required="">
                </div>
                <div class="form-group col-md-6 col-sm-6 mb-3">
                  <label>Re-Enter New Password</label>
                  <input type="password" name="UserPassword_2" oninput="checkpass()" id="pass2" class="form-control" required="">
                </div>
                <br>
                <div class="col-md-12 text-right mt-3">
                  <button type="Submit" name="UpdatePassword" class="btn btn-lg btn-success">Update Password</button>
                </div>
              </div>
            </form>
          </div>
        </div>






      </div><!-- col -->
    </div><!-- row -->

  </div>


  <?php

  include $Dir . "assets/FooterFiles.php";
  ?>

</body>

</html>