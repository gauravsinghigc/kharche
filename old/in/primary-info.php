<?php
//auto load required files
$Dir = "..";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
require $Dir . "/modules/MainModuleHandler.php";
require $Dir . "/modules/CommonModuleHandler.php";

//check login status
ApplicationUserAccess("REQUIRED");

//page variable
$PageName = IfRequested("GET", "view", "Account Details", false);
?>
<!DOCTYPE html>
<html>

<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
 <meta name="description" content="">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php
 SystemHeaderFiles();
 MainHeaderFiles();
 ?>
 <script type="text/javascript">
  function SidebarActive() {
   document.getElementById("account").classList.add("active");
  }
  window.onload = SidebarActive;
 </script>
</head>

<body>
 <header class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="flex-s-b">
     <div class="w-50 text-left">
      <a href="account.php" class='btn btn-white btn-md shadow-sm rounded mt-2'><i class="fa fa-angle-left text-primary"></i> Back to Account</a>
     </div>
     <div class="w-50 m-l-5 text-right">
      <img src="<?php echo APP_LOGO; ?>" class="img-fluid app-header-logo">
     </div>
    </div>
   </div>
  </div>
 </header>
 <div class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="flex-s-b">
     <div class="w-25">
      <img src="<?php echo AuthAppUser("UserProfileImage"); ?>" class="mx-auto d-block rounded img-fluid app-acc-img">
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
     <div class="w-75 p-2">
      <h5 class="mb-0"><b><?php echo AuthAppUser("UserFullName"); ?></b></h5>
      <p class="small">
       <span><i class="fa fa-phone text-success"></i> <?php echo AuthAppUser("UserPhoneNumber"); ?></span><br>
       <span><i class="fa fa-envelope text-danger"></i> <?php echo AuthAppUser("UserEmailId"); ?></span><br>
       <span><i class="fa fa-cake text-warning"></i> <?php echo AuthAppUser("UserDateOfBirth"); ?></span>
      </p>
     </div>
    </div>
   </div>
  </div>
 </div>
 <section class="container pb-5 mb-5 mt-3">
  <div class="row">
   <div class="col-md-12 col-lg-12 col-sm-12 col-12">
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
       <input type="text" name="UserFullName" value="<?php echo AuthAppUser("UserFullName"); ?>" class="form-control form-control-lg" required="">
      </div>
      <div class="form-group col-md-6 col-sm-6 mb-3">
       <label>Phone Number</label>
       <input type="text" name="UserPhoneNumber" value="<?php echo AuthAppUser("UserPhoneNumber"); ?>" class="form-control form-control-lg" required="">
      </div>
      <div class="form-group col-md-6 col-sm-6 mb-4">
       <label>Email Id</label>
       <input type="email" readonly="" name="UserEmailId" value="<?php echo AuthAppUser("UserEmailId"); ?>" class="form-control form-control-lg" required="">
      </div>
      <div class="form-group col-md-6 col-sm-6 mb-4">
       <label>App Price Type</label>
       <select name="UserPriceType" class="form-control form-control-lg" required="">
        <?php InputOptions([
         "₹", "$", "€", "£", "د.ك"
        ], AuthAppUser("UserPriceType")); ?>
       </select>
      </div>
      <br>
      <div class="col-md-12 text-right">
       <button type="Submit" name="UpdateProfile" class="btn btn-md system-btn">Update Details <i class='fa fa-check'></i></button>
      </div>
     </div>
    </form>
   </div>

  </div>
 </section>
 <?php
 include $Dir . "/include/common/SystemPushAlerts.php";
 include $Dir . "/include/main/Navbar.php";
 include $Dir . "/include/main/Copyrighted.php";
 SystemFooterFiles();
 MainFooterFiles(); ?>
</body>

</html>