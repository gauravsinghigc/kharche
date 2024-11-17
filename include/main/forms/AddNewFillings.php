<section class="app-data-box hidden" id="AddFuelEntry">
  <div class="container">
    <div class="row">
      <div class="col-md-12 mt-4">
        <div class="flex-s-b">
          <h4 class="app-heading w-75"><i class='fa fa-gas-pump text-primary'></i> Add New Filling</h4>
          <a href="#" onclick="Databar('AddFuelEntry')" class="p-1 text-danger"><i class="fa fa-times fs-1"></i></a>
        </div>
      </div>
    </div>
    <form enctype="multipart/form-data" class="form" action="<?php echo CONTROLLER("ModuleController/FillingController.php"); ?>" method="POST">
      <?php FormPrimaryInputs(true, [
        "MainUserId" => AuthAppUser("UserId"),
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
                  if ($VehicleId == $Vehicle->VehicleId) {
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
            <input type="number" name="FillingOdoMeterReading" class="form-control form-control-lg" required="" min="1" max="">
          </div>
        </div>

        <div class="flex-s-b mb-2">
          <div class="form-group w-75 m-1">
            <label>Filling (in L/Kg/G)</label>
            <input type="text" name="FillingQuantity" value='1' oninput="CalculatePrice()" id="fillingqty" class="form-control form-control-lg" required="" min="1" max="">
          </div>
          <div class="form-group w-75 m-1">
            <label>Net Qty in Tank</label>
            <input type="text" name="CurrentFillingLevel" value='1' class="form-control form-control-lg" required="" min="1" max="">
          </div>
          <div class="form-group w-25 m-1">
            <label>Type</label>
            <select name="FilledFuelType" class="form-control form-control-lg">
              <?php InputOptions(['L', "Kg", "Gallon"]); ?>
            </select>
          </div>
        </div>

        <div class="flex-s-b mb-2">
          <div class="form-group w-50 m-1">
            <label>Price Per Unit (in <?php echo AuthAppUser("UserPriceType"); ?>)</label>
            <input type="text" value='1' oninput="CalculatePrice()" id="fillingprice" name="FillingPricePerLiter" class="form-control form-control-lg" required="" min="1" max="">
          </div>
          <div class="form-group w-50 m-1">
            <label>Total Filling Cost (in <?php echo AuthAppUser("UserPriceType"); ?>)</label>
            <input type="text" value='1' oninput="CalculatePrice()" id="netprice" name="FillingNetPrice" class="form-control form-control-lg" required="" min="1" max="">
          </div>
        </div>

        <div class="flex-s-b mb-2">
          <div class="form-group w-50 m-1">
            <label>Filling date</label>
            <input type="date" value="<?php echo date("Y-m-d"); ?>" name="FillingDate" class="form-control form-control-lg" required="">
          </div>
          <div class="form-group w-50 m-1">
            <label>Filling Time</label>
            <input type="time" value="<?php echo date("h:i"); ?>" name="FillingTime" class="form-control form-control-lg" required="">
          </div>
        </div>
        <div class="flex-s-b mb-2">
          <div class="form-group w-100 m-1">
            <label>Filling Station Name</label>
            <input type="text" required name="FillingStationName" list="FillingStationName" rows=" 3" class="form-control form-control-lg">
          </div>
        </div>

        <div class="col-md-12 text-center">
          <button type="Submit" name="CreateFillingRecord" class="btn btn-lg system-btn"><i class='fa fa-check'></i> Save Filling Record</button>
        </div>
      </div>
    </form>
  </div>
</section>
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