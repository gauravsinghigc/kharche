<?php
//auto load required files
$Dir = "..";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";


//page variable
$PageName = IfRequested("GET", "view", "Privacy Policy", false);
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
        <h1>Privacy Policy for (<?php echo APP_NAME; ?>) managed by GAURAVSINGHIGC.IN</h1>

        <p>This privacy policy ("Policy") explains how Kharche ("we," "us," or "our") collects, uses, and shares information about you when you use our website, mobile application, and other online products and services (collectively, the "Services").</p>

        <p>Please read this Policy carefully to understand our policies and practices regarding your information and how we will treat it. If you do not agree with our policies and practices, do not use our Services. By accessing or using our Services, you agree to this Policy. This Policy may change from time to time. Your continued use of our Services after we make changes is deemed to be acceptance of those changes, so please check the Policy periodically for updates.</p>

        <h2>1. Information We Collect</h2>

        <p>We may collect several types of information from and about users of our Services, including:</p>

        <ul>
          <li>Personal data, such as your name, email address, postal address, and phone number.</li>
          <li>Demographic data, such as your age, gender, and interests.</li>
          <li>Technical data, such as your IP address, browser type and version, time zone setting, browser plug-in types and versions, operating system, and platform.</li>
          <li>Usage data, such as information about how you use our Services, including search queries, page view statistics, and access times.</li>
          <li>Location data, such as your location when you use our Services.</li>
        </ul>

        <p>We may collect this information directly from you, or we may collect it through third-party sources. We may also collect information about you automatically when you use our Services, as described in the "Cookies and Other Tracking Technologies" section below.</p>

        <h2>2. How We Use Your Information</h2>

        <p>We use the information we collect from and about you to provide, maintain, protect, and improve our Services, and to develop new ones. More specifically, we may use your information to:</p>

        <ul>
          <li>Communicate with you, including responding to your inquiries and sending you technical notices, updates, security alerts, and support and administrative messages.</li>
          <li>Personalize and improve your experience, including by providing content and recommendations that are more relevant to you.</li>
          <li>Analyze and understand how our Services are used, and to improve and optimize them.</li>
          <li>Protect our Services and our users, and to prevent fraud, spam, abuse, and other harmful activity.</li>
          <li>Comply with legal obligations and industry standards, and to enforce our policies.</li>
        </ul>

        <h2>3. Sharing Your Information</h2>

        <p>We may share your information with third parties for the following purposes:</p>

        <ul>
          <li>With service providers and business partners who perform services on our behalf, such as hosting, analytics, payment processing, and customer service. These third parties may have access to your information as necessary to perform their functions, but they are not permitted to

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