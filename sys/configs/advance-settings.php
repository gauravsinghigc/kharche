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
$PageName = IfRequested("GET", "view", "Appplication Configurations", false);
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
   document.getElementById("configs").classList.add("active");
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
     <?php include "c-nav.php"; ?>

     <div class="row">
      <div class="col-md-12">
       <div class="flex-s-b">
        <h4 class="main-heading mb-0"><i class="fa fa-gears"></i><?php echo $PageName; ?></h4>
       </div>
       <hr class="mt-2">
      </div>
      <div class="col-md-4 col-lg-4 col-sm-6 col-12">
       <div class="">
        <h4 class="app-heading">Mailing Configurations</h4>
        <form class="form row" action="<?php echo CONTROLLER("SystemController/ConfigController.php"); ?>" method="POST">
         <?php FormPrimaryInputs(true); ?>
         <div class="form-group form-group-2 col-md-12">
          <label>Mail Function</label>
          <select name="CONTROL_MAILS" onchange="enablemails()" id="mailingstatus" class="form-control" required="">
           <?php
           $mailstatus = CONTROL_MAILS;
           if ($mailstatus == "true") { ?>
            <option value="false">Disabled</option>
            <option value="true" selected="">Enabled</option>
           <?php } else { ?>
            <option value="false" selected="">Disabled</option>
            <option value="true">Enabled</option>
           <?php  } ?>

          </select>
         </div>
         <?php if ($mailstatus == "true") {
          $mailstatus = ""; ?>
         <?php } else {
          $mailstatus = "style='display:none;'";  ?>
         <?php } ?>
         <div id="showemailoptions" <?php echo $mailstatus; ?>>
          <div class="form-group form-group-2 col-md-12">
           <label for="SENDER_MAIL_ID">Sender Mail-ID</label>
           <input type="email" name="SENDER_MAIL_ID" value="<?php echo SENDER_MAIL_ID; ?>" class="form-control">
          </div>
          <div class="form-group form-group-2 col-md-12">
           <label for="SENDER_MAIL_ID">Receiver Mail-ID</label>
           <input type="email" name="RECEIVER_MAIL" value="<?php echo RECEIVER_MAIL; ?>" class="form-control">
          </div>
          <div class="form-group form-group-2 col-md-12">
           <label for="SENDER_MAIL_ID">Customer Support Mail-ID</label>
           <input type="email" name="SUPPORT_MAIL" value="<?php echo SUPPORT_MAIL; ?>" class="form-control">
          </div>
          <div class="form-group form-group-2 col-md-12">
           <label for="SENDER_MAIL_ID">Enquiry Mail-ID</label>
           <input type="email" name="ENQUIRY_MAIL" value="<?php echo ENQUIRY_MAIL; ?>" class="form-control">
          </div>
          <div class="form-group form-group-2 col-md-12">
           <label for="SENDER_MAIL_ID">Admin Mail-ID</label>
           <input type="email" name="ADMIN_MAIL" value="<?php echo ADMIN_MAIL; ?>" class="form-control">
          </div>
         </div>
         <div class="col-md-12 m-t-10">
          <button type="Submit" name="UpdateMailConfigs" class="btn btn-md system-btn">Update Details</button>
         </div>
        </form>
       </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
       <div class="">
        <h4 class="app-heading">Payment Gateway Setup</h4>
        <form action="" method="GET" class="row form">
         <div class="form-group form-group col-md-12">
          <label>Select Payment Gateway Provider</label>
          <select name="PG_PROVIDER" class="form-control" required="" onchange="form.submit()">
           <?php foreach (PG_OPTIONS as $pgoptions) {
            if (isset($_GET['PG_PROVIDER'])) {
             if ($_GET['PG_PROVIDER'] == $pgoptions) {
              $selected = "selected";
             } else {
              $selected = "";
             }
            } else {
             if (CONFIG("PG_PROVIDER") == $pgoptions) {
              $selected = "selected";
             } else {
              $selected = "";
             }
            } ?>
            <option value="<?php echo $pgoptions; ?>" <?php echo $selected; ?>><?php echo $pgoptions; ?></option>
           <?php } ?>
          </select>
         </div>
        </form>
        <form class="form row" action="<?php echo CONTROLLER("SystemController/ConfigController.php"); ?>" method="POST">
         <?php if (isset($_GET['PG_PROVIDER'])) {
          $PG_PROVIDER = $_GET['PG_PROVIDER'];
         } else {
          $PG_PROVIDER = CONFIG("PG_PROVIDER");
         } ?>
         <input type="hidden" name="PG_PROVIDER" value="<?php echo $PG_PROVIDER; ?>">
         <?php FormPrimaryInputs(true); ?>
         <div class="form-group form-group-2 col-md-12">
          <label>Enable/Disable Online Payments</label>
          <select name="ONLINE_PAYMENT_OPTION" onchange="enablepaymentgateway()" id="pgstatus" class="form-control" required="">
           <?php
           $pgstatus = ONLINE_PAYMENT_OPTION;
           if ($pgstatus == "true") { ?>
            <option value="false">Disabled</option>
            <option value="true" selected="">Enabled</option>
           <?php } else { ?>
            <option value="false" selected="">Disabled</option>
            <option value="true">Enabled</option>
           <?php  } ?>

          </select>
         </div>
         <?php if ($pgstatus == "true") {
          $pgstatus = ""; ?>
         <?php } else {
          $pgstatus = "style='display:none;'";  ?>
         <?php } ?>
         <div id="pgoptions" <?php echo $pgstatus; ?>>
          <div class="form-group form-group-2 col-md-12">
           <label for="PG_MODE">PG Mode <small><i class="fa fa-angle-right"></i> eg: prod, test, dev, live</small></label>
           <input type="text" name="PG_MODE" value="<?php echo CONFIG("PG_MODE"); ?>" class="form-control text-uppercase">
          </div>
          <div class="form-group form-group-2 col-md-12">
           <label for="MERCHENT_ID">Merchant ID</label>
           <input type="text" name="MERCHENT_ID" value="<?php echo CONFIG("MERCHENT_ID"); ?>" class="form-control">
          </div>
          <div class="form-group form-group-2 col-md-12">
           <label for="MERCHANT_KEY">Merchant Key</label>
           <input type="text" name="MERCHANT_KEY" value="<?php echo CONFIG("MERCHANT_KEY"); ?>" class="form-control">
          </div>
         </div>
         <div class="col-md-12 m-t-10">
          <button type="Submit" name="UpdatePgDetails" class="btn btn-md system-btn">Update Details</button>
         </div>
        </form>
       </div>
      </div>

      <div class="col-lg-4 col-md-4 col-sm-4 col-12">
       <div class="">
        <h4 class="app-heading">Enable & Disable features</h4>
        <form class="form row" action="<?php echo CONTROLLER("SystemController/ConfigController.php"); ?>" method="POST">
         <?php FormPrimaryInputs(true); ?>
         <div class="form-group form-group-2 col-md-12">
          <label>Work Environment</label>
          <?php if (CONTROL_WORK_ENV == "PROD") { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_WORK_ENV" Value="PROD" checked=""> <span class="fs-17">Production</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_WORK_ENV" Value="DEV"> <span class="fs-17">Development</span>
            </span>
           </div>
          <?php } else { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_WORK_ENV" Value="PROD"> <span class="fs-17">Production</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_WORK_ENV" Value="DEV" checked=""> <span class="fs-17">Development</span>
            </span>
           </div>
          <?php } ?>
         </div>
         <div class="form-group form-group-2 col-md-12">
          <label>Desktop Notifications</label>
          <?php if (CONFIG("CONTROL_NOTIFICATION") == "true") { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION" Value="true" checked=""> <span class="fs-17">Enable</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION" Value="false"> <span class="fs-17">Disabled</span>
            </span>
           </div>
          <?php } else { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION" Value="true"> <span class="fs-17">Enable</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION" Value="false" checked=""> <span class="fs-17">Disabled</span>
            </span>
           </div>
          <?php } ?>
         </div>
         <div class="form-group form-group-2 col-md-12">
          <label>Desktop Notifications Sound</label>
          <?php if (CONFIG("CONTROL_NOTIFICATION_SOUND") == "true") { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="true" checked=""> <span class="fs-17">Enable</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="false"> <span class="fs-17">Disabled</span>
            </span>
           </div>
          <?php } else { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="true"> <span class="fs-17">Enable</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_NOTIFICATION_SOUND" Value="false" checked=""> <span class="fs-17">Disabled</span>
            </span>
           </div>
          <?php } ?>
         </div>
         <div class="form-group form-group-2 col-md-12">
          <label>Alert Display Time (eg: 2000 for 2sec)</label>
          <input type="number" name="CONTROL_MSG_DISPLAY_TIME" class="form-control" required="" value="<?php echo CONFIG("CONTROL_MSG_DISPLAY_TIME"); ?>">
         </div>
         <div class="form-group form-group-2 col-md-12">
          <label>Activity Logs</label>
          <?php if (CONTROL_APP_LOGS == "true") { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_APP_LOGS" Value="true" checked=""> <span class="fs-17">Enable</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_APP_LOGS" Value="false"> <span class="fs-17">Disabled</span>
            </span>
           </div>
          <?php } else { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="CONTROL_APP_LOGS" Value="true"> <span class="fs-17">Enable</span>
            </span>
            <span>
             <input type="radio" name="CONTROL_APP_LOGS" Value="false" checked=""> <span class="fs-17">Disabled</span>
            </span>
           </div>
          <?php } ?>
         </div>
         <div class="form-group form-group-2 col-md-12">
          <label>Website Status</label>
          <?php if (WEBSITE == "true") { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="WEBSITE" Value="true" checked=""> <span class="fs-17">Live</span>
            </span>
            <span>
             <input type="radio" name="WEBSITE" Value="false"> <span class="fs-17">Coming Soon</span>
            </span>
           </div>
          <?php } else { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="WEBSITE" Value="true"> <span class="fs-17">Live</span>
            </span>
            <span>
             <input type="radio" name="WEBSITE" Value="false" checked=""> <span class="fs-17">Coming Soon</span>
            </span>
           </div>
          <?php } ?>
         </div>
         <div class="form-group form-group-2 col-md-12">
          <label>Mobile App Status</label>
          <?php if (APP == "true") { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="APP" Value="true" checked=""> <span class="fs-17">Live</span>
            </span>
            <span>
             <input type="radio" name="APP" Value="false"> <span class="fs-17">Coming Soon</span>
            </span>
           </div>
          <?php } else { ?>
           <div class="flex-s-b">
            <span>
             <input type="radio" name="APP" Value="true"> <span class="fs-17">Live</span>
            </span>
            <span>
             <input type="radio" name="APP" Value="false" checked=""> <span class="fs-17">Coming Soon</span>
            </span>
           </div>
          <?php } ?>
         </div>
         <div class="col-md-12 m-t-10">
          <button type="Submit" name="UpdateFeatures" class="btn btn-md system-btn">Update Details</button>
         </div>
        </form>
       </div>
      </div>
     </div>
     <script>
      function enablemails() {
       var mailingstatus = document.getElementById("mailingstatus");
       if (mailingstatus.value == "true") {
        document.getElementById("showemailoptions").style.display = "block";
       } else {
        document.getElementById("showemailoptions").style.display = "none";
       }
      }
     </script>
     <script>
      function enablepaymentgateway() {
       var pgstatus = document.getElementById("pgstatus");
       if (pgstatus.value == "true") {
        document.getElementById("pgoptions").style.display = "block";
       } else {
        document.getElementById("pgoptions").style.display = "none";
       }
      }
     </script>

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