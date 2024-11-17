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
  $FillingId = SECURE($_GET['id'], "d");
  $_SESSION['VEHICLE_FILLING_ID'] = $FillingId;
} else {
  $FillingId = $_SESSION['VEHICLE_UPDATE_ID'];
}
$PageSQL = "SELECT * FROM fillings where FillingId='$FillingId'";
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
            <a href="fuel.php" class='btn btn-white btn-md shadow-sm rounded mt-2'><i class="fa fa-angle-left text-primary"></i> Back to Fillings</a>
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
        <h5 class='app-heading'><i class='fa fa-gas-pump'></i> Update Filling Details</h5>
      </div>
    </div>
    <form class="form" action="<?php echo CONTROLLER("ModuleController/FillingController.php"); ?>" method="POST">
      <?php FormPrimaryInputs(true, [
        "FillingId" => $FillingId,
      ]); ?>
      <div class="row">
        <div class="flex-s-b mb-2">
          <div class="form-group w-100 m-1">
            <label>Select Vehicle</label>
            <select name="MainVehicleId" class="form-control form-control-lg" required="">
              <option value='0'>Select Vehicle</option>
              <?php
              $Vehicles = _DB_COMMAND_("SELECT * FROM vehicles where MainUserId='" . AuthAppUser('UserId') . "'", true);
              if ($Vehicles != null) {
                foreach ($Vehicles as $Vehicle) {
                  if (FETCH($PageSQL, "MainVehicleId") == $Vehicle->VehicleId) {
                    $selected = "selected";
                  } else {
                    $selected = "";
                  } ?>
                  <option value="<?php echo $Vehicle->VehicleId; ?>" <?php echo $selected; ?>><?php echo $Vehicle->VehcileName; ?> (<?php echo $Vehicle->VehicleRegNo; ?>)</option>
              <?php
                }
              }
              ?>
            </select>
          </div>
          <div class="form-group w-50 m-1">
            <label>ODO Meter</label>
            <input type="number" value="<?php echo FETCH($PageSQL, "FillingOdoMeterReading"); ?>" name="FillingOdoMeterReading" class="form-control form-control-lg" required="">
          </div>
        </div>

        <div class="flex-s-b mb-2">
          <div class="form-group w-75 m-1">
            <label>Filling (in L/Kg/G)</label>
            <input type="text" name="FillingQuantity" value="<?php echo FETCH($PageSQL, "FillingQuantity"); ?>" oninput="CalculatePrice()" id="fillingqty" class="form-control form-control-lg" required="" min="1" max="">
          </div>
          <div class="form-group w-50 m-1">
            <label>Net Qty in Tank</label>
            <input type="text" name="CurrentFillingLevel" value='<?php echo FETCH($PageSQL, "FilledPreviousQty"); ?>' class="form-control form-control-lg" required="" min="1" max="">
          </div>
          <div class="form-group w-25 m-1">
            <label>Type</label>
            <select name="FilledFuelType" class="form-control form-control-lg">
              <?php InputOptions(['L', "Kg", "Gallon"], FETCH($PageSQL, "FilledFuelType")); ?>
            </select>
          </div>
        </div>

        <div class="flex-s-b mb-2">
          <div class="form-group w-50 m-1">
            <label>Price Per Unit (in <?php echo AuthAppUser("UserPriceType"); ?>)</label>
            <input type="text" value="<?php echo FETCH($PageSQL, "FillingPricePerLiter"); ?>" oninput="CalculatePrice()" id="fillingprice" name="FillingPricePerLiter" class="form-control form-control-lg" required="" min="1" max="">
          </div>
          <div class="form-group w-50 m-1">
            <label>Total Filling Cost (in <?php echo AuthAppUser("UserPriceType"); ?>)</label>
            <input type="text" value="<?php echo FETCH($PageSQL, "FillingNetPrice"); ?>" oninput="CalculatePrice()" id="netprice" name="FillingNetPrice" class="form-control form-control-lg" required="" min="1" max="">
          </div>
        </div>

        <div class="flex-s-b mb-2">
          <div class="form-group w-50 m-1">
            <label>Filling date</label>
            <input type="date" name="FillingDate" value="<?php echo FETCH($PageSQL, "FillingDate"); ?>" class="form-control form-control-lg" required="">
          </div>
          <div class="form-group w-50 m-1">
            <label>Filling Time</label>
            <input type="time" name="FillingTime" value="<?php echo FETCH($PageSQL, "FillingTime"); ?>" class="form-control form-control-lg" required="">
          </div>
        </div>
        <div class="flex-s-b mb-2">
          <div class="form-group w-100 m-1">
            <label>Filling Station Name</label>
            <textarea name="FillingStationName" rows="3" class="form-control form-control-lg"><?php echo FETCH($PageSQL, "FillingStationName"); ?></textarea>
          </div>
        </div>

        <div class="col-md-12 text-right">
          <button type="Submit" name="UpdateFillingRecord" class="btn btn-md system-btn"><i class='fa fa-check'></i> Update Filling Record</button>
        </div>
      </div>
      <div class="col-md-12 mt-5 text-center">
        <?php
        CONFIRM_DELETE_POPUP(
          "vehicle_fillings_request",
          [
            "remove_vehicle_filling_record" => "true",
            "FillingId" => $FillingId,
          ],
          "ModuleController/FillingController",
          "<i class='fa fa-trash'></i> Remove Filling Entry",
          "text-danger"
        );
        ?>
      </div>
    </form>

  </section>
  <?php
  include $Dir . "/include/common/SystemPushAlerts.php";
  include $Dir . "/include/main/Navbar.php";
  include $Dir . "/include/main/Copyrighted.php";
  SystemFooterFiles();
  MainFooterFiles(); ?>

  <script>
  function CalculatePrice() {
    var fillingqty = document.getElementById("fillingqty");
    var fillingprice = document.getElementById("fillingprice");
    var netprice = document.getElementById("netprice");

    if (fillingqty.value == 0 || netprice.value == 0) {

    } else {
      var fillingprices = netprice.value / fillingqty.value;
      var fillingprices = parseFloat(fillingprices.toFixed(2));
      fillingprice.value = fillingprices;
    }



  }
</script>
</body>

</html>