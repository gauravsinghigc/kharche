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
  $VehicleId = SECURE($_GET['id'], "d");
  $_SESSION['VEHICLE_UPDATE_ID'] = $VehicleId;
} else {
  $VehicleId = $_SESSION['VEHICLE_UPDATE_ID'];
}
$PageSQL = "SELECT * FROM vehicles where VehicleId='$VehicleId'";
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
      document.getElementById("vehicles").classList.add("active");
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
            <a href="vehicles.php" class='btn btn-white btn-md shadow-sm rounded mt-2'><i class="fa fa-angle-left text-primary"></i> Back to Vehicles</a>
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
        <h5 class='app-heading'><i class='fa fa-truck'></i> Update Vehicle Details</h5>
      </div>
    </div>
    <form class="form" action="<?php echo CONTROLLER("ModuleController/VehicleController.php"); ?>" method="POST">
      <?php FormPrimaryInputs(true, [
        "VehicleId" => $VehicleId,
      ]); ?>
      <div class="row">
        <div class="flex-s-b mb-2">
          <div class="form-group w-75 m-1">
            <label>Vehicle Name</label>
            <input type="text" name="VehcileName" value="<?php echo FETCH($PageSQL, "VehcileName"); ?>" tabindex="1" class="form-control form-control-lg" required="">
          </div>
          <div class="form-group w-50 m-1">
            <label>Brand Name</label>
            <input type="text" name="VehicleBrandName" value="<?php echo FETCH($PageSQL, "VehicleBrandName"); ?>" list="VehicleBrandName" class="form-control form-control-lg" required="">
            <?php SUGGEST("vehicles", "VehicleBrandName", "ASC"); ?>
          </div>
        </div>
        <div class="flex-s-b mb-2">
          <div class="form-group w-50 m-1">
            <label>Vehicle Type</label>
            <select name="VehcileType" class="form-control form-control-lg" required>
              <?php InputOptions(['Truck', "Car", "Bike", "SUV"], FETCH($PageSQL, "VehcileType")); ?>
            </select>
          </div>
          <div class="form-group w-50 m-1">
            <label>Fuel Type</label>
            <select name="VehcileFuelType" class="form-control form-control-lg" required>
              <?php InputOptions(['Petrol', "Diesel", "Gasoline", "CNG/Petrol", "CNG", "BioFuel", "Electric"], FETCH($PageSQL, "VehcileFuelType")); ?>
            </select>
          </div>
        </div>
        <div class="flex-s-b mb-2">
          <div class="form-group w-50 m-1">
            <label>Modal Name</label>
            <input type="text" name="VehicleModalNo" value="<?php echo FETCH($PageSQL, "VehicleModalNo"); ?>" list="VehicleModalNo" class="form-control form-control-lg" required="">
            <?php SUGGEST("vehicles", "VehicleModalNo", "ASC"); ?>
          </div>
          <div class="form-group w-50 m-1">
            <label>Reg No</label>
            <input type="text" name="VehicleRegNo" value="<?php echo FETCH($PageSQL, "VehicleRegNo"); ?>" class="form-control form-control-lg" required="">
          </div>
        </div>
        <div class="flex-s-b mb-2">
          <div class="form-group w-75 m-1">
            <label>Engine No</label>
            <input type="text" name="VehicleEngineNo" value="<?php echo FETCH($PageSQL, "VehicleEngineNo"); ?>" class="form-control form-control-lg">
          </div>
          <div class="form-group w-50 m-1">
            <label>Max. Fuel Capacity</label>
            <input type="number" min='1' name="VehicleMaxFuel" value="<?php echo FETCH($PageSQL, "VehicleMaxFuel"); ?>" class="form-control form-control-lg" required="">
          </div>
        </div>
        <div class="flex-s-b mb-2">
          <div class="form-group w-100">
            <label>Chassis No</label>
            <input type="" name="VehicleChasisNo" value="<?php echo FETCH($PageSQL, "VehicleChasisNo"); ?>" class="form-control form-control-lg">
          </div>
        </div>

        <div class="col-md-12 text-center">
          <button type="Submit" name="UpdateVehicleDetails" class="btn btn-lg system-btn"><i class='fa fa-check'></i> Update Vehicle Details</button>
        </div>

        <div class="col-md-12 mt-5 text-center">
          <?php
          $Check = CHECK("SELECT * FROM fillings where MainVehicleId='$VehicleId'");
          if ($Check == null) {
            CONFIRM_DELETE_POPUP(
              "vehicle_request",
              [
                "remove_vehicle_record" => "true",
                "vehicle_id" => $_SESSION['VEHICLE_UPDATE_ID'],
              ],
              "ModuleController/VehicleController",
              "<i class='fa fa-trash'></i> Remove Vehicle",
              "text-danger"
            );
          }; ?>
        </div>
      </div>
    </form>
  </section>
  <?php
  include $Dir . "/include/common/SystemPushAlerts.php";
  include $Dir . "/include/main/Navbar.php";
  include $Dir . "/include/main/Copyrighted.php";
  SystemFooterFiles();
  MainFooterFiles(); ?>
</body>

</html>