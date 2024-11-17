<?php
//auto load required files
$Dir = "..";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";


//page variable
$PageName = IfRequested("GET", "view", "Contact Us", false);
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
  <style>
    p,
    ul li {
      text-align: justify !important;
    }
  </style>
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
  <div class='container'>
    <div class='row'>
      <div class='col-md-12'>
        <form action="<?php echo CONTROLLER("ModuleController/EnquiryController.php"); ?>" method="POST">
          <?php FormPrimaryInputs(true); ?>
          <div class="row">
            <div class="col-md-6 col-sm-6 col-12 form-group">
              <label>Full Name</label>
              <input type="text" name="EnqFullname" class="form-control form-control-md" required="">
            </div>
            <div class="col-md-6 col-sm-6 col-12 form-group">
              <label>Email Id</label>
              <input type="email" name="EnqEmailId" class="form-control form-control-md" required="">
            </div>
            <div class="col-md-6 col-sm-6 col-12 form-group">
              <label>Phone Number</label>
              <input type="tel" name="EnqPhoneNumber" class="form-control form-control-md" required="">
            </div>
            <div class="col-md-6 col-sm-6 col-12 form-group">
              <label>Message</label>
              <textarea name="EnqDetails" class="form-control form-control-md" rows="4"></textarea>
            </div>
            <div class="col-md-12 mt-3 text-right">
              <button type="submit" name="SaveEnquiry" class="btn btn-md system-btn"><i class='fa fa-share'></i> Send Details</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php
  include $Dir . "/include/common/SystemPushAlerts.php";
  include $Dir . "/include/main/Copyrighted.php";
  SystemFooterFiles();
  MainFooterFiles(); ?>
</body>

</html>