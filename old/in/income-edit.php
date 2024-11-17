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

if (isset($_GET['id'])) {
 $IncomeId = SECURE($_GET['id'], "d");
 $_SESSION['INCOME_UPDATE_ID'] = $IncomeId;
} else {
 $IncomeId = $_SESSION['INCOME_UPDATE_ID'];
}
$PageSQL = "SELECT * FROM income where IncomeId='$IncomeId'";
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
   document.getElementById("expanses").classList.add("active");
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
      <a href="expanses.php" class='btn btn-white btn-md shadow-sm rounded mt-2'><i class="fa fa-angle-left text-primary"></i> Back to Income</a>
     </div>
     <div class="w-50 m-l-5 text-right">
      <img src="<?php echo APP_LOGO; ?>" class="img-fluid app-header-logo">
     </div>
    </div>
   </div>
  </div>
 </header>

 <section class="container">
  <div class="row">
   <div class="col-md-12">
    <h5 class='app-heading mt-0'><i class='fa fa-exchange'></i> Update Income Details</h5>
   </div>
  </div>
  <form class="form" action="<?php echo CONTROLLER("ModuleController/IncomeController.php"); ?>" method="POST">
   <?php FormPrimaryInputs(true, [
    "IncomeId" => $IncomeId,
   ]); ?>
   <div class="row">
    <div class='flex-s-b mb-2'>
     <div class="form-group w-100 m-1">
      <label>Income Name</label>
      <input type="text" name="IncomeName" value="<?php echo FETCH($PageSQL, "IncomeName"); ?>" placeholder="Like Salary, coupon etc" tabindex="1" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-75 m-1">
      <label>Amount</label>
      <input type="text" name="IncomeAmount" value="<?php echo FETCH($PageSQL, "IncomeAmount"); ?>" placeholder="<?php echo AuthAppUser('UserPriceType'); ?>" tabindex="1" class="form-control form-control-lg" required="">
     </div>
     <div class="form-group w-50 m-1">
      <label>Date</label>
      <input type="date" value="<?php echo FETCH($PageSQL, "IncomeReceiveDate"); ?>" name="IncomeReceiveDate" tabindex="1" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="mb-2">
     <div class="form-group w-100 m-1">
      <label>Income Source</label>
      <input type="text" name="IncomeSource" value="<?php echo FETCH($PageSQL, "IncomeSource"); ?>" list="IncomeSource" class="form-control form-control-lg" required="">
      <?php SUGGEST("income", "IncomeSource", "ASC"); ?>
     </div>
    </div>
    <div class="mb-2">
     <div class="form-group w-100 m-1">
      <label>Income Tags</label>
      <input type="text" name="IncomeTags" value="<?php echo FETCH($PageSQL, "IncomeTags"); ?>" list="IncomeTags" class="form-control form-control-lg" required="">
      <?php SUGGEST("income", "IncomeTags", "ASC"); ?>
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-100 m-1">
      <label>Add Notes</label>
      <textarea name="IncomeNotes" rows="3" class="form-control form-control-lg"><?php echo SECURE(FETCH($PageSQL, "IncomeNotes"), "d"); ?></textarea>
     </div>
    </div>

    <div class="col-md-12 text-center">
     <button type="Submit" name="UpdateIncomeEntery" class="btn btn-md system-btn"><i class='fa fa-check'></i> Update Income Entry</button>
     <br><br><br><br><br><br>
     <?php
     CONFIRM_DELETE_POPUP(
      "income_list",
      [
       "remove_income_record" => "true",
       "control_id" => $IncomeId,
      ],
      "ModuleController/IncomeController",
      "<i class='fa fa-trash'></i> Remove Income Entry",
      "text-danger mt-4"
     );
     ?>
    </div>
   </div>
  </form>
 </section>
 <br><br><br>
 <?php
 include $Dir . "/include/common/SystemPushAlerts.php";
 include $Dir . "/include/main/Navbar.php";
 include $Dir . "/include/main/Copyrighted.php";
 SystemFooterFiles();
 MainFooterFiles(); ?>
</body>

</html>