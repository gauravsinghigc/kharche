<?php
$Dir = "../../../";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";

if (isset($_GET['id'])) {
  $CustomerViewId = SECURE($_GET['id'], "d");
  $_SESSION['CustomerViewId'] = $CustomerViewId;
} else {
  $CustomerViewId = $_SESSION['CustomerViewId'];
}

$PageName = "All Sales";
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

  <title><?php echo $PageName; ?> - <?php echo APP_NAME; ?></title>
  <?php include  $Dir . "assets/HeaderFiles.php"; ?>
  <script>
    window.onload = function() {
      document.getElementById("customers").classList.add("active");
    }
  </script>
</head>

<body>
  <?php
  include $Dir . "include/Sidebar.php";
  include $Dir . "include/Header.php";
  ?>
  <div class="main main-app p-lg-4">
    <div class="container-fluid">

      <div class="shadow-sm p-1">
        <div class="row">
          <div class="col-md-4 col-3 mt-3 text-center pr-0">
            <div class="name-word app-text mb-1 h1 mt-0"><?php echo FirstWord(Customers($CustomerViewId, "customer_name")); ?></div>
          </div>
          <div class="col-md-8 col-9 pl-0">
            <div class="mt-3">
              <h5 class="mb-1"><?php echo Customers($CustomerViewId, "customer_name"); ?></h5>
              <p class="text-secondary mb-1 small">
                <small>
                  <a class="h5 text-secondary small" href="tel:<?php echo Customers($CustomerViewId, "customer_phone_number"); ?>">
                    <i class="fa fa-phone-square text-primary"></i> <?php echo Customers($CustomerViewId, "customer_phone_number"); ?>
                  </a><br>
                </small>
                <small>
                  <a class='h5 text-secondary small' href="mailto:<?php echo Customers($CustomerViewId, "customer_email_id"); ?>">
                    <i class="fa fa-envelope text-danger"></i> <?php echo Customers($CustomerViewId, "customer_email_id"); ?>
                  </a><br>
                </small>
                <small><i class="fa fa-map-marker text-success"></i> <?php echo Customers($CustomerViewId, "customer_area") . ", " . Customers($CustomerViewId, "customer_city") . ", " . Customers($CustomerViewId, "customer_state"); ?></small><br>
              </p>
            </div>
          </div>
        </div>
      </div>


      <div class="row">
        <div class="col-md-12">
          <hr>
          <div class="flex-s-b">
            <div class="p-2 w-50 shadow-sm m-1">
              <h5 class="mb-0 text-info">Rs.0000</h5>
              <small class="text-secondary mb-0 mt-0 small">Sale</small>
            </div>
            <div class="p-2 w-50 shadow-sm m-1">
              <h5 class="mb-0 text-success">Rs.0000</h5>
              <small class="text-secondary mb-0 mt-0 small">Received</small>
            </div>
            <div class="p-2 w-50 shadow-sm m-1">
              <h5 class="mb-0 text-danger">Rs.0000</h5>
              <small class="text-secondary pt-0 mb-0 mt-0 small">Balance</small>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12 mt-2">
          <div class="flex-s-b">
            <a href="" class='btn btn-sm btn-info text-white'><i class="fa fa-exchange"></i> Orders</a>
            <a href="" class='btn btn-sm btn-success'><i class="fa fa-arrow-down"></i> Received</a>
            <a href="" class='btn btn-sm btn-danger'><i class="fa fa-arrow-up"></i> Paid</a>
            <a href="" class='btn btn-sm btn-secondary'><i class="fa fa-file-pdf"></i> Documents</a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <hr>
          <div class="flex-s-b mt-3">
            <form class="w-50 text-right">
              <input type="month" class="form-control h4" value='<?php echo date('Y-m'); ?>'>
            </form>
            <a href="" class="btn btn-md btn-default"><i class="fa fa-download"></i> Export</a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <?php
  include $Dir . "assets/FooterFiles.php";
  ?>

</body>

</html>