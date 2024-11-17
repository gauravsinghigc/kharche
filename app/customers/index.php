<?php
$Dir = "../../";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
$PageName = "My Customers";
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

  <title>Profile - <?php echo APP_NAME; ?></title>
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
      <div class="row">
        <div class="col-md-10 col-8 mt-3">
          <form>
            <input type="search" name='search' id='searching' placeholder="Search Customer..." onchange="form.submit()" oninput="SearchData('searching', 'data-records')" class="form-control form-control-md">
          </form>
        </div>
        <div class="col-md-2 col-4 mt-3">
          <a href="<?php echo APP_URL; ?>/customers/create" class='btn btn-md btn-danger btn-block'><i class="fa fa-plus"></i> Add New</a>
        </div>
      </div>

      <div class="row mt-3">
        <?php
        $AllCustomers = _DB_COMMAND_("SELECT * FROM customers where customer_main_user_id='" . LOGIN_USER_ID . "' ORDER BY customer_name ASC", true);
        if ($AllCustomers != null) {
          foreach ($AllCustomers as $Customer) {
        ?>
            <div class="col-md-4 mb-2 data-records">
              <a href="<?php echo APP_URL; ?>/customers/details/?id=<?php echo SECURE($Customer->customer_id, "e"); ?>">
                <div class="shadow-sm p-2 bg-white">
                  <div class="row">
                    <div class="col-xs-4 col-4">
                      <div class="name-word app-text"><?php echo FirstWord($Customer->customer_name); ?></div>
                    </div>
                    <div class="col-xs-8 col-8">
                      <h5 class="text-black bold mb-1 mt-1"><?php echo LimitText($Customer->customer_name, 0, 20); ?></h5>
                      <p class="mb-2 text-secondary">
                        <small><i class="fa fa-map-marker text-success"></i> <?php echo $Customer->customer_area . ", " . $Customer->customer_city; ?></small><br>
                        <small><i class="fa fa-cake text-danger"></i> <?php echo DATE_FORMATES("d M, Y", $Customer->customer_date_of_birth); ?></small><br>
                        <small><i class="fa fa-phone text-primary"></i> <?php echo $Customer->customer_phone_number; ?></small>
                      </p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
        <?php
          }
        } else {
          NoData("No Customer Found!", "It seemds there is no customers in the database!");
        } ?>
      </div>
    </div>
  </div>


  <?php
  include $Dir . "assets/FooterFiles.php";
  ?>

</body>

</html>