<?php
$Dir = "../";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
$PageName = "Dashboard";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Meta -->
  <meta name="description" content="">
  <meta name="author" content="<?php echo APP_NAME; ?>">

  <title>Dashboard - <?php echo APP_NAME; ?></title>
  <?php include  $Dir . "assets/HeaderFiles.php"; ?>
  <script>
    window.onload = function() {
      document.getElementById("dashboard").classList.add("active");
    }
  </script>

</head>

<body>
  <?php
  include $Dir . "include/Sidebar.php";
  include $Dir . "include/Header.php";
  ?>
  <div class="main main-app p-3 p-lg-4">



  </div>


  <?php
  include $Dir . "assets/FooterFiles.php";
  ?>

</body>

</html>