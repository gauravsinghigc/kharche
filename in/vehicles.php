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
$Vehicle = 0;
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
            <a href="index.php" class='btn btn-white btn-md shadow-sm rounded mt-2'><i class="fa fa-truck text-primary"></i> All Vehicles</a>
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
      <?php
      $Vehicles = _DB_COMMAND_("SELECT * FROM vehicles where MainUserId='" . AuthAppUser('UserId') . "'", true);
      if ($Vehicles != null) {
        foreach ($Vehicles as $Vehicle) {
          $VehicleId = $Vehicle->VehicleId; ?>
          <div class='col-md-12 mb-2'>
            <div class='box-shadow p-2'>
              <a href="edit-vehicles.php?id=<?php echo SECURE($Vehicle->VehicleId, "e"); ?>">
                <div class='flex-s-b'>
                  <div class='w-25 m-1'>
                    <img src="<?php echo STORAGE_URL_D; ?>/vehicle/<?php echo $Vehicle->VehcileType; ?>.png" class='img-fluid mt-4'>
                  </div>
                  <div class='w-100 m-1'>
                    <h6 class='mb-0'><?php echo $Vehicle->VehcileName; ?> <i class='text-secondary text-uppercase pull-right'><?php echo $Vehicle->VehicleRegNo; ?></i></h6>
                    <p class='data-display mb-0'>
                      <span class='flex-s-b'>
                        <span>
                          <span class='text-grey'>Type</span><br>
                          <span><?php echo $Vehicle->VehcileType; ?></span>
                        </span>
                        <span>
                          <span class='text-grey'>Brand Name</span><br>
                          <span class="text-uppercase"><?php echo $Vehicle->VehicleBrandName; ?></span>
                        </span>
                        <span>
                          <span class='text-grey'>Modal No</span><br>
                          <span><?php echo $Vehicle->VehicleModalNo; ?></span>
                        </span>
                      </span>
                      <span class="flex-s-b">
                        <span>
                          <span class='text-grey'>Fuel Type</span><br>
                          <span><?php echo $Vehicle->VehcileFuelType; ?></span>
                        </span>
                        <span>
                          <span class='text-grey'>Max Fuel Capacity</span><br>
                          <span><?php echo $Vehicle->VehicleMaxFuel; ?> L</span>
                        </span>
                        <span>
                          <span class='text-grey'>Engine No</span><br>
                          <span class="text-uppercase"><?php echo $Vehicle->VehicleEngineNo; ?></span>
                        </span>
                      </span>
                      <span class='flex-s-b'>
                        <span>
                          <span class='text-grey'>Chassis No</span><br>
                          <span class="text-uppercase"><?php echo $Vehicle->VehicleChasisNo; ?></span>
                        </span>
                        <span>
                          <span class='text-grey'>Created At</span><br>
                          <span><?php echo DATE_FORMATES("d M, Y", $Vehicle->VehicleCreatedAt); ?></span>
                        </span>
                      </span>
                    </p>
                  </div>
                </div>
              </a>
              <p class="data-display-2 bg-success text-white p-2 mt-1 mb-0">
                <span class="flex-s-b">
                  <span>
                    <span class='text-grey'>Net Fillings </span><br>
                    <span><?php echo $Qty = AMOUNT("SELECT * FROM fillings where MainVehicleId='$VehicleId'", "FillingQuantity"); ?> <?php echo FETCH("SELECT * FROM fillings where MainVehicleId='" . $VehicleId . "'", "FilledFuelType"); ?></span>
                  </span>
                  <span>
                    <span class='text-grey'>Net Cost</span><br>
                    <span><?php echo AuthAppUser("UserPriceType"); ?> <?php echo $NetSpend = AMOUNT("SELECT * FROM fillings where  MainVehicleId='$VehicleId'", "FillingNetPrice"); ?></span>
                  </span>
                  <span>
                    <span class='text-grey'>ODO Reading</span><br>
                    <span><?php echo $Distance = FETCH("SELECT * FROM fillings where MainVehicleId='" . $VehicleId . "' ORDER BY FillingId desc limit 0, 1", "FillingOdoMeterReading"); ?> Km </span>
                  </span>
                  <span>
                    <span class='text-grey'>Mileage</span><br>
                    <span>
                      <?php
                      if ($Qty == 0) {
                        $Qty = 1;
                      }
                      echo round($Distance / $Qty, 2);
                      ?> Km/L </span>
                  </span>
                  <span>
                    <span class='text-grey'>Cost/Km</span><br>
                    <span>
                      <?php
                      echo AuthAppUser("UserPriceType") . " ";
                      if ($Distance == 0) {
                        echo "0";
                      } else {
                        echo round($NetSpend / $Distance, 2);
                      }
                      ?></span>
                  </span>
                </span>
              </p>
            </div>
          </div>
      <?php }
      } else {
        NoData("No vehicles found!");
      } ?>
    </div>
  </section>

  <?php
  include $Dir . "/include/common/SystemPushAlerts.php";
  include $Dir . "/include/main/Navbar.php";
  include $Dir . "/include/main/Copyrighted.php";
  SystemFooterFiles();
  MainFooterFiles(); ?>
</body>

</html>