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
  <meta name="viewport" content="width=device-width, initial-scale=0.85">
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
      <h6 class='text-black text-capitalize shadow-sm rounded p-2 mt-2'><i class='fa fa-user text-primary'></i> <?php echo $PageName; ?></h6>
     </div>
     <div class="w-50 m-l-5 text-right">
      <img src="<?php echo APP_LOGO; ?>" class="img-fluid app-header-logo">
     </div>
    </div>
   </div>
  </div>
 </header>
 <div class="container mt-2">
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
      <p class='account-info'>
       <span><i class="fa fa-phone text-primary"></i> <?php echo AuthAppUser("UserPhoneNumber"); ?></span><br>
       <span><i class="fa fa-envelope text-danger"></i> <?php echo AuthAppUser("UserEmailId"); ?></span><br>
       <span><i class="fa fa-cake text-warning"></i> <?php echo DATE_FORMATES("d M, Y", AuthAppUser("UserDateOfBirth")); ?></span>
      </p>
     </div>
    </div>
   </div>
  </div>
 </div>

 <section class="container">
  <div class="row">
   <div class="col-md-12">
    <ul class="account-nav">
     <li>
      <a href="primary-info.php"><i class="fa fa-user"></i> Primary Details <i class="fa fa-angle-right"></i></a>
     </li>
     <li>
      <a href="security.php"><i class="fa fa-key"></i> Change Password <i class="fa fa-angle-right"></i></a>
     </li>
     <li>
      <a href="vehicles.php"><i class="fa fa-truck"></i> My Vehicles <i class="fa fa-angle-right"></i></a>
     </li>
     <li>
      <a href="privacy-policy.php"><i class="fa fa-file"></i> Privacy Policy <i class="fa fa-angle-right"></i></a>
     </li>
     <li>
      <a href="support.php"><i class="fa fa-info-circle"></i> Support & Contact Us <i class="fa fa-angle-right"></i></a>
     </li>
     <li>
      <a href="../logout.php"><i class="fa fa-sign-out"></i> Logout <i class="fa fa-angle-right"></i></a>
     </li>
    </ul>
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