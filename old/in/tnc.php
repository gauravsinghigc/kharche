<?php
//auto load required files
$Dir = "..";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";


//page variable
$PageName = IfRequested("GET", "view", "Terms & Conditions", false);
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
      <a href="../auth/main/?sign-up=true" class='btn btn-white btn-md shadow-sm rounded mt-2'><i class="fa fa-angle-left text-primary"></i> Back to Signup</a>
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
    <h5 class='app-heading mt-0'><i class='fa fa-certificate'></i> <?php echo $PageName; ?></h5>
   </div>

   <div class='col-md-12'>
    <h1>Terms and Conditions</h1>

    <p>Welcome to Kharche, a mobile application for managing expenses ("App"). The following terms and conditions ("Terms") govern your use of the App. By accessing or using the App, you agree to be bound by these Terms and our <a href="#privacy-policy">Privacy Policy</a>.</p>

    <h2>1. Eligibility</h2>

    <p>The App is intended for users who are at least 18 years old. By using the App, you represent and warrant that you are at least 18 years old and have the legal capacity to enter into a binding contract.</p>

    <h2>2. Account Registration</h2>

    <p>To access certain features of the App, you will need to create an account. You are responsible for safeguarding your account login information and for any and all activity that occurs under your account. You agree to notify us immediately of any unauthorized use of your account.</p>

    <h2>3. License and Intellectual Property</h2>

    <p>Subject to your compliance with these Terms, we grant you a limited, non-exclusive, non-transferable, revocable license to access and use the App. You may not sell, rent, lease, distribute, sublicense, or otherwise transfer any part of the App to any third party. You may not copy, modify, or create derivative works based on the App. You may not reverse engineer, decompile, or disassemble the App. You may not remove, alter, or obscure any copyright, trademark, or other proprietary rights notice on or in the App.</p>

    <p>The App and all content and materials included on it, including but not limited to text, graphics, logos, images, and software, are the property of Kharche or its licensors and are protected by copyright and trademark laws. You may not use any content or materials on the App for any commercial purpose without the express written consent of Kharche.</p>

    <h2>4. User Content</h2>

    <p>The App may allow you to submit, post, or transmit text, photos, videos, or other content ("User Content"). You retain all ownership rights in your User Content, but by submitting, posting, or transmitting User Content to or through the App, you grant us a perpetual, irrevocable, worldwide, royalty-free, and fully sublicensable license to use, reproduce, modify, adapt, publish, translate, create derivative works from, distribute, perform, and display your User Content in any media or medium, and for any purpose.</p>

    <p>You are solely responsible for your User Content and for the consequences of submitting, posting, or transmitting it. You represent and warrant that your User Content is accurate, not confidential, and not in violation of any third-party rights. You may not submit, post, or transmit User Content that is unlawful, defamatory, obscene, spam, or otherwise inappropriate.</p>

    <h2>5. Disclaimer of Warranties</h2>

    <p>The App is provided on an "as is" and "as available" basis. We do not warrant that the App will be uninterrupted or error-free. We do not make any representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or
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