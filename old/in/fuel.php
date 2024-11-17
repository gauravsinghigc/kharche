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
$PageName = IfRequested("GET", "view", "Fuel Fillings", false);
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
            <h6 class='text-black text-capitalize shadow-sm rounded p-2 mt-2'><i class='fa fa-gas-pump text-primary'></i> <?php echo $PageName; ?></h6>
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
        <form class="row">
          <input type='hidden' name="viewingmonth" value="<?php echo IfRequested("GET", "viewingmonth", date('Y-m'), null); ?>">
          <div class="col-md-12">
            <div class="form-group w-100">
              <select name="ViewFor" onchange="form.submit()" class="form-control form-control-lg" required="">
                <?php
                $Vehicles = _DB_COMMAND_("SELECT * FROM vehicles where MainUserId='" . AuthAppUser('UserId') . "'", true);
                if ($Vehicles != null) {
                  foreach ($Vehicles as $Vehicle) {
                    if (isset($_GET['ViewFor'])) {
                      $VehicleId = $_GET['ViewFor'];
                      if ($Vehicle->VehicleId == $VehicleId) {
                        $selected = "selected=''";
                      } else {
                        $selected = "";
                      }
                    } else {
                      $selected = "";
                    } ?>
                    <option value="<?php echo $Vehicle->VehicleId; ?>" <?php echo $selected; ?>> Fuel Record For : <?php echo $Vehicle->VehcileName; ?> (<?php echo $Vehicle->VehicleRegNo; ?>)</option>
                <?php
                  }
                }
                ?>
              </select>
            </div>
          </div>
        </form>
      </div>
      <?php
      if (isset($_GET['ViewFor'])) {
        $ViewFor = $_GET['ViewFor'];
        $Vehicles = _DB_COMMAND_("SELECT * FROM vehicles where VehicleId='$ViewFor' and MainUserId='" . AuthAppUser('UserId') . "'", true);
      } else {
        $Vehicles = _DB_COMMAND_("SELECT * FROM vehicles where MainUserId='" . AuthAppUser('UserId') . "' order by VehicleId ASC limit 0, 1", true);
      }
      if ($Vehicles != null) {
        foreach ($Vehicles as $Vehicle) {
          $VehicleId = $Vehicle->VehicleId; ?>
          <div class='col-md-12 mb-1'>
            <div class='shadow-sm vehilce-data p-2'>
              <div class='flex-s-b'>
                <div class='w-20 m-1'>
                  <img src="<?php echo STORAGE_URL_D; ?>/vehicle/<?php echo $Vehicle->VehcileType; ?>.png" class='img-fluid mt-3'>
                </div>
                <div class='w-100 m-1'>
                  <h5 class='mb-0'><?php echo $Vehicle->VehcileName; ?> <i class='text-secondary text-uppercase pull-right h6'><?php echo $Vehicle->VehicleRegNo; ?></i></h5>
                  <p class='data-display mb-0'>
                    <span class='flex-s-b'>
                      <span class="w-pr-50">
                        <span class='text-grey'>Type</span><br>
                        <span><?php echo $Vehicle->VehcileType; ?></span>
                      </span>
                      <span class="w-pr-50">
                        <span class='text-grey'>Brand Name</span><br>
                        <span class="text-uppercase"><?php echo $Vehicle->VehicleBrandName; ?></span>
                      </span>
                      <span class="w-pr-50">
                        <span class='text-grey'>Modal No</span><br>
                        <span><?php echo $Vehicle->VehicleModalNo; ?></span>
                      </span>
                    </span>
                    <span class="flex-s-b">
                      <span class="w-pr-50">
                        <span class='text-grey'>Fuel Type</span><br>
                        <span><?php echo $Vehicle->VehcileFuelType; ?></span>
                      </span>
                      <span class="w-pr-50">
                        <span class='text-grey'>Max Fuel Capacity</span><br>
                        <span><?php echo $Vehicle->VehicleMaxFuel; ?> L</span>
                      </span>
                      <span class="w-pr-50">
                        <span class='text-grey'>Engine No</span><br>
                        <span class="text-uppercase"><?php echo $Vehicle->VehicleEngineNo; ?></span>
                      </span>
                    </span>
                  </p>
                </div>
              </div>
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
        $VehicleId = IfRequested('GET', 'ViewFor', $Vehicle->VehicleId, null);
        $ViewMonth = date("m", strtotime(IfRequested('GET', "viewingmonth", date('Y-m'), null)));
        $ViewYear = date("Y", strtotime(IfRequested('GET', "viewingmonth", date('Y-m'), null)));
      } else {
        NoData("No vehicles found!");
        $VehicleId = "";
        $ViewMonth = "";
      }
      ?>
    </div>
    <div class="row">
      <div class='col-md-12 mt-1'>
        <div class='flex-s-b'>
          <h6 class='pt-2 m-1 w-100'><i class='fa fa-gas-pump text-danger'></i> Filling History</h6>
          <form class='w-50 m-1'>
            <input type="hidden" name="ViewFor" value="<?php echo $VehicleId; ?>">
            <input type="month" onchange="form.submit()" name="viewingmonth" class='form-control form-control-sm pt-2' value='<?php echo IfRequested("GET", "viewingmonth", date('Y-m'), null); ?>'>
          </form>
        </div>
      </div>
    </div>
    <div class='row'>
      <div class="col-md-12">
        <p class="data-display-2 bg-primary text-white p-2 mt-1">
          <span class="flex-s-b">
            <span class='w-25 text-left'>
              <span class='text-grey'>Filling Qty</span><br>
              <span><?php echo $Qty = AMOUNT("SELECT * FROM fillings where MONTH(FillingDate)='$ViewMonth' and YEAR(FillingDate)='$ViewYear' and MainVehicleId='$VehicleId'", "FillingQuantity"); ?> L</span>
            </span>
            <span class='w-25 text-left'>
              <span class='text-grey'>Fuel Cost</span><br>
              <span><?php echo AuthAppUser("UserPriceType"); ?> <?php echo $NetSpend = AMOUNT("SELECT * FROM fillings where MONTH(FillingDate)='$ViewMonth' and YEAR(FillingDate)='$ViewYear' and MainVehicleId='$VehicleId'", "FillingNetPrice"); ?></span>
            </span>
            <span class='w-25 text-right'>
              <span class='text-grey'>ODO Reading</span><br>
              <span><?php echo $Distance = FETCH("SELECT * FROM fillings where MONTH(FillingDate)='$ViewMonth' and YEAR(FillingDate)='$ViewYear' and MainVehicleId='" . $VehicleId . "' ORDER BY FillingId DESC limit 0, 1", "FillingOdoMeterReading"); ?> Km </span>
            </span>
            <span class='w-25 text-right'>
              <span class='text-grey'>Km in <?php echo DATE_FORMATES("M, Y", $ViewMonth); ?></span><br>
              <span>
                <?php
                $Distance = AMOUNT("SELECT * FROM fillings where MONTH(FillingDate)='$ViewMonth' and YEAR(FillingDate)='$ViewYear' and MainVehicleId='" . $VehicleId . "'", "FilledDistanceKm");
                echo $Distance = $Distance;
                ?> Km </span>
            </span>
          </span>
          <span class="flex-s-b mt-2">
            <span class='w-25 text-left'>
              <span class='text-grey'>Per Day Km</span><br>
              <span>
                <?php
                $numDays = date('t', strtotime("$ViewMonth"));
                $Distance = AMOUNT("SELECT * FROM fillings where MONTH(FillingDate)='$ViewMonth' and YEAR(FillingDate)='$ViewYear' and MainVehicleId='" . $VehicleId . "'", "FilledDistanceKm");
                echo round($Distance / $numDays, 2);
                ?> Km/day </span>
            </span>
            <span class='w-25 text-left'>
              <span class='text-grey'>Mileage</span><br>
              <span>
                <?php
                if ($Qty == 0) {
                  $Qty = 1;
                }
                echo round($Distance / $Qty, 2);
                ?> Km/L </span>
            </span>
            <span class='w-25 text-right'>
              <span class='text-grey'>Cost/Km</span><br>
              <span>
                <?php echo AuthAppUser("UserPriceType"); ?>
                <?php
                if ($Distance == 0) {
                  echo $CostPerKmForRunningMonth = 0;
                } else {
                  echo $CostPerKmForRunningMonth = round($NetSpend / $Distance, 2);
                } ?>
              </span>
            </span>
            <span class='w-25 text-right'>
              <span class='text-grey'>Cost/100Km</span><br>
              <span>
                <?php echo AuthAppUser("UserPriceType"); ?><?php echo $Cost100KmForRunningMonth = $CostPerKmForRunningMonth * 100; ?></span>
            </span>
          </span>
        </p>
      </div>

      <?php
      if (isset($_GET['viewingmonth'])) {
        $AllFillings = _DB_COMMAND_("SELECT * FROM fillings where MONTH(FillingDate)='$ViewMonth' and YEAR(FillingDate)='$ViewYear' and MainVehicleId='" . $VehicleId . "' ORDER BY Date(FillingDate) DESC", true);
      } else {
        $AllFillings = _DB_COMMAND_("SELECT * FROM fillings where MainVehicleId='" . $VehicleId . "' ORDER BY Date(FillingDate) DESC", true);
      }
      if ($AllFillings != null) {
        $SerialNo = 0;
        foreach ($AllFillings as $Filling) {
          $SerialNo++;
          $CostPerUnit = $Filling->FillingPricePerLiter;
          $NetCost = FETCH("SELECT * FROM fillings where FillingId!='" . $Filling->FillingId . "' and FillingId<='" . $Filling->FillingId . "' and MainVehicleId='" . $VehicleId . "' ORDER BY FillingId DESC limit 0, 1", "FillingNetPrice");
          $PreviousDriveKm = $Filling->FilledDistanceKm;
          $PreviousFilledQty = FETCH("SELECT * FROM fillings where FillingId!='" . $Filling->FillingId . "' and FillingId<='" . $Filling->FillingId . "' and MainVehicleId='" . $VehicleId . "' ORDER BY FillingId DESC limit 0, 1", "FilledPreviousQty");
          $NetKmDriven = $PreviousDriveKm;

          if ($PreviousFilledQty == 0) {
            $PreviousFilledQty = 1;
          }

          $NetMileage =  round($NetKmDriven / $PreviousFilledQty, 2);

          $CostForPerKm = round($NetCost / $NetKmDriven, 2);
          $CostForHundredKm = $CostForPerKm * 100;
          $CostForThousandsKm = $CostForPerKm * 1000;


          $QtyPerKm = round($NetKmDriven / $PreviousFilledQty, 2);
          $QtyPerHundred = round(100 / $NetMileage, 2);
          $QtyPerThousands = round(1000 / $NetMileage, 2);
      ?>
          <div class="col-md-12 mb-1">
            <a href="edit-fuel.php?id=<?php echo SECURE($Filling->FillingId, "e"); ?>">
              <div class='flex-s-b filling-list'>
                <div class='w-100 p-1'>
                  <h6 class='mb-0 small'><small><i class='fa fa-gas-pump text-danger fs-6 small'></i> </small>
                  <?php echo $Filling->FillingOdoMeterReading; ?> km 
                  <span class='text-success fs-6 km-driven'> +<?php echo $NetKmDriven; ?> Km</span>
                    <span class='text-gray'> <i class='fa fa-dashboard text-gray'></i> 
                    <?php echo $NetMileage; ?> km/<?php echo $Filling->FilledFuelType; ?></span>
                    <small class='text-gray fs-6 pull-right'><span class='p-1'><?php echo DATE_FORMATES("d M,", $Filling->FillingDate); ?> <?php echo DATE_FORMATES("h:i A", $Filling->FillingTime); ?>
                    </span>
                    </small>
                  </h6>
                  <p class='data-display-2 mb-0 mt-1'>
                    <span class="flex-s-b">
                      <span class='w-20 bg-white text-center m-1 rounded-2'>
                        <span class='text-gray'>In Tank</span><br>
                        <b class='bold'><?php echo $PreviousFilledQty; ?> <?php echo $Filling->FilledFuelType; ?></b>
                      </span>
                      <span class='w-20 m-1 text-center'>
                        <span class='text-gray'>Filling Qty</span><br>
                        <span><?php echo $Filling->FillingQuantity; ?> <?php echo $Filling->FilledFuelType; ?></span>
                      </span>
                      <span class='w-20 m-1 text-center'>
                        <span class='text-gray'>Per Unit</span><br>
                        <span><?php echo AuthAppUser("UserPriceType"); ?><?php echo $Filling->FillingPricePerLiter; ?>/<?php echo $Filling->FilledFuelType; ?></span>
                      </span>
                      <span class='w-20 m-1 text-center'>
                        <span class='text-gray'>Net Cost</span><br>
                        <span><?php echo AuthAppUser("UserPriceType"); ?> <?php echo $Filling->FillingNetPrice; ?></span>
                      </span>
                      <span class='w-20 m-1 text-center'>
                        <span class='text-gray'>Cost/Km</span><br>
                        <span><?php echo AuthAppUser("UserPriceType"); ?> <?php echo $CostForPerKm; ?></span>
                      </span>
                      <span class='w-20 m-1 text-center'>
                        <span class='text-gray'>Cost/100km</span><br>
                        <span><?php echo AuthAppUser("UserPriceType"); ?> <?php echo $CostForHundredKm; ?></span>
                      </span>
                    </span>
                    <span class='flex-s-b mt-1'>
                      <span class='w-20 m-1 text-center'>
                        <span class='text-gray'>For 100 km</span><br>
                        <span><?php echo $QtyPerHundred; ?> <?php echo $Filling->FilledFuelType; ?></span>
                      </span>
                      <span class='w-100 m-1 text-left'>
                        <span class='text-gray'>Filling Station</span><br>
                        <span class='small'> <?php echo $Filling->FillingStationName; ?></span>
                      </span>
                    </span>
                  </p>
                </div>
              </div>
            </a>
          </div>
      <?php }
      } else {
        NoData("No Filling Found!");
      } ?>
    </div>
  </section>
  <br><br><br><br><br><br><br><br>
  <?php
  include $Dir . "/include/common/SystemPushAlerts.php";
  include $Dir . "/include/main/Navbar.php";
  include $Dir . "/include/main/Copyrighted.php";
  SystemFooterFiles();
  MainFooterFiles(); ?>
</body>

</html>