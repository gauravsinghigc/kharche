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
 <?php SystemHeaderFiles(); ?>
</head>

<body class="sys-bg">
 <section class="container">
  <div class="row">
   <div class="col-md-12">
    <div class="shadow-sm sys-auth-bg sys-access-box mx-auto d-block p-3 mt-5">
     <img src="<?php echo APP_LOGO; ?>" class="w-25 d-block mx-auto">
     <h4 class="bold text-center mt-2"><?php echo APP_NAME; ?></h4>
     <hr>
     <?php
     if (isset($_GET['password-reset'])) {
      include __DIR__ . "../../../include/auth/admin/PasswordResetForm.php";
     } elseif (isset($_GET['verify'])) {
      include __DIR__ . "../../../include/auth/admin/VerifyLinkSent.php";
     } elseif (isset($_GET['reset'])) {
      include __DIR__ . "../../../include/auth/admin/ResetPassword.php";
     } else {
      SystemUserAccess("PROVIDED");
      include __DIR__ . "../../../include/auth/admin/LoginForm.php";
     } ?>
    </div>
   </div>
  </div>
 </section>
 <?php
 include $Dir . "/include/common/sys-developer-footer.php"; ?>
 <?php SystemFooterFiles(); ?>
</body>

</html>