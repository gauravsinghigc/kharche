<?php
//auto load required files
$Dir = "..";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
require $Dir . "/modules/AdminModuleHandler.php";
require $Dir . "/modules/CommonModuleHandler.php";

//check login status
SystemUserAccess("REQUIRED");

//page variable
$PageName = IfRequested("GET", "view", "Dashboard", false);
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
   document.getElementById("dashboard").classList.add("active");
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

     <!-- Main Content Start here -->
     <?php include $Dir . "/view/admin/Dashboard.php"; ?>
     <!-- main content end here -->

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