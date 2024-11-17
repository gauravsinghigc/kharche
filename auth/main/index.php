<?php
$Dir = "../..";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";

//page name 
$PageName = IfRequested("GET", "view", "Login Page", false);
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <title><?php echo $PageName; ?> | <?php echo APP_NAME; ?></title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php
 SystemHeaderFiles();
 MainHeaderFiles(); ?>
</head>

<body class="sys-bg">
 <section class="container">
  <div class="row">
   <div class="col-md-6 col-12">
    <div class="app-mode">
     <img src="<?php echo APP_LOGO; ?>" class="app-logo">
     <?php
     if (isset($_GET['password-reset'])) {
      include __DIR__ . "../../../include/auth/main/PasswordResetForm.php";
     } elseif (isset($_GET['verify'])) {
      include __DIR__ . "../../../include/auth/main/VerifyLinkSent.php";
     } elseif (isset($_GET['sign-up'])) {
      ApplicationUserAccess("PROVIDED");
      include __DIR__ . "../../../include/auth/main/SignUpForm.php";
     } elseif (isset($_GET['reset'])) {
      include __DIR__ . "../../../include/auth/main/ResetPassword.php";
     } else {
      ApplicationUserAccess("PROVIDED");
      include __DIR__ . "../../../include/auth/main/LoginForm.php";
     } ?>
    </div>
   </div>
  </div>
 </section>
 <?php
 include $Dir . "/include/common/SystemPushAlerts.php";
 SystemFooterFiles();
 MainFooterFiles(); ?>
</body>

</html>