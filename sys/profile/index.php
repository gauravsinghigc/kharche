<?php
//auto load required files
$Dir = "../..";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
require $Dir . "/modules/AdminModuleHandler.php";
require $Dir . "/modules/CommonModuleHandler.php";

//check login status
SystemUserAccess("REQUIRED");

//page variable
$PageName = IfRequested("GET", "view", "Profile", false);
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
 AdminHeaderFiles();
 ?>
 <script type="text/javascript">
  function SidebarActive() {
   document.getElementById("profile").classList.add("active");
  }
  window.onload = SidebarActive;
 </script>
</head>

<body>
 <?php
 include $Dir . "/include/admin/Header.php";
 ?>
 <section class="container-fluid">
  <div class="row">
   <div class="col-md-3">
    <?php include $Dir . "/include/admin/Sidebar.php"; ?>
   </div>

   <div class="col-md-9">
    <div class="sys-main-content">

     <div class="row">
      <div class="col-md-12">
       <div class="flex-s-b">
        <h4 class="main-heading mb-0"><i class="fa fa-home"></i><?php echo $PageName; ?></h4>
       </div>
       <hr class="mt-2">

       <div class="row">
        <div class="col-md-8 col-lg-8 col-sm-7 col-12">
         <form class="form" action="<?php echo CONTROLLER("ModuleController/UserController.php"); ?>" method="POST">
          <?php FormPrimaryInputs(
           true,
           [
            "UserId" => AuthUser("UserId"),
           ]
          ) ?>
          <div class="row">
           <div class="col-md-12 col-sm-12">
            <h4 class="app-sub-heading">Personal Details</h4>
           </div>
           <?php FormPrimaryInputs(true); ?>
           <div class="form-group col-md-6 col-sm-6">
            <label>Full Name</label>
            <input type="text" name="UserFullName" value="<?php echo AuthUser("UserFullName"); ?>" class="form-control" required="">
           </div>
           <div class="form-group col-md-6 col-sm-6">
            <label>Phone Number</label>
            <input type="text" name="UserPhoneNumber" value="<?php echo AuthUser("UserPhoneNumber"); ?>" class="form-control" required="">
           </div>
           <div class="form-group col-md-6 col-sm-6">
            <label>Email Id</label>
            <input type="email" name="UserEmailId" value="<?php echo AuthUser("UserEmailId"); ?>" class="form-control" required="">
           </div>
           <br>
           <div class="col-md-12">
            <br>
            <button type="Submit" name="UpdateProfile" class="btn btn-md btn-success">Update Details</button>
           </div>
          </div>
         </form>
         <hr>
         <form class="form" action="<?php echo CONTROLLER("ModuleController/UserController.php"); ?>" method="POST">
          <?php FormPrimaryInputs(true); ?>
          <div class="row">
           <div class="col-md-12 col-sm-12">
            <h4 class="app-sub-heading">Update Password <span id="passmsg"></span></h4>
           </div>
           <div class="form-group col-md-6 col-sm-6">
            <label>Enter New Password</label>
            <input type="password" name="UserPassword" oninput="checkpass()" id="pass1" class="form-control" required="">
           </div>
           <div class="form-group col-md-6 col-sm-6">
            <label>Re-Enter New Password</label>
            <input type="password" name="UserPassword_2" oninput="checkpass()" id="pass2" class="form-control" required="">
           </div>
           <br>
           <div class="col-md-12">
            <br>
            <button type="Submit" name="UpdatePassword" class="btn btn-md btn-success">Update Password</button>
           </div>
          </div>
         </form>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-5 col-12">
         <div class="br10 p-2 border-success">
          <h6 class="app-heading">Upload Profile Image</h6>
          <div class="br10 app-bg-light p-3">
           <center>
            <img src="<?php echo AuthUser("UserProfileImage"); ?>" class="w-25 mx-auto d-block rounded config-logo" style="border-radius:100% !important;">
           </center>

           <form class="form m-t-3" action="<?php echo CONTROLLER("ModuleController/UserController.php"); ?>" method="POST" enctype="multipart/form-data">
            <input type="text" name="updateprofileimage" value="<?php echo AuthUser("UserId"); ?>" hidden="">
            <input type="text" name="current_img" value="<?php echo SECURE(AuthUser("UserProfileImage"), "e"); ?>" hidden="">
            <?php FormPrimaryInputs(true); ?>
            <label for="UploadProfileimg">
             <img src="<?php echo STORAGE_URL_D; ?>/tool-img/img-upload.png" class="w-pr-10 w-25">
            </label>
            <input type="file" class="hidden" onchange="form.submit()" hidden="" name="UserProfileImage" id="UploadProfileimg" value="<?php echo APP_LOGO; ?>" accept="images/*">
           </form>
          </div>
          <p class="m-t-10">
           <span class="fs-20"> <?php echo AuthUser("UserFullName");; ?></span><br>
           <span><i class="fa fa-phone text-info"></i> <?php echo AuthUser("UserPhoneNumber");; ?></span><br>
           <span><i class="fa fa-envelope text-danger"></i> <?php echo AuthUser("UserEmailId");; ?></span><br>
           <span><i class="fa fa-user text-warning"></i> <?php echo AuthUser("UserRole");; ?></span><br>
           <span><i class="fa fa-calendar text-primary"></i> CreatedAt: <?php echo AuthUser("UserCreatedBy"); ?></span><br>
           <span><i class="fa fa-calendar text-primary"></i> UpdatedAt: <?php echo AuthUser("UserUpdatedBy"); ?></span><br>
          </p>
         </div>
        </div>
       </div>


      </div>
     </div>

    </div>
   </div>
  </div>
 </section>
 <?php
 include $Dir . "/include/common/sys-developer-footer.php";
 SystemFooterFiles();
 AdminFooterFiles(); ?>
</body>

</html>