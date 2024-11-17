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
$PageName = IfRequested("GET", "view", "Home", false);
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
      document.getElementById("home").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body>
  <?php
  include $Dir . "/include/main/Header.php";
  ?>
  <section class='container'>
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
            <a href="fuel.php?ViewFor=<?php echo $Vehicle->VehicleId; ?>&viewingmonth=<?php echo date('Y-m'); ?>">
              <div class='shadow-sm vehilce-data p-2'>
                <div class='flex-s-b'>
                  <div class='w-20 m-1'>
                    <img src="<?php echo STORAGE_URL_D; ?>/vehicle/<?php echo $Vehicle->VehcileType; ?>.png" class='img-fluid mt-3'>
                  </div>
                  <div class='w-100 m-1'>
                    <h5 class='mb-0'><?php echo $Vehicle->VehcileName; ?> <i class='text-secondary text-uppercase pull-right h6'><?php echo $Vehicle->VehicleRegNo; ?></i></h5>
                    <p class='data-display mb-0'>
                      <span class='flex-s-b'>
                        <span class='w-100'>
                          <span class='text-grey'>Type</span><br>
                          <span><?php echo $Vehicle->VehcileType; ?></span>
                        </span>
                        <span class='w-100'>
                          <span class='text-grey'>Brand Name</span><br>
                          <span class="text-uppercase"><?php echo $Vehicle->VehicleBrandName; ?></span>
                        </span>
                        <span class='w-100'>
                          <span class='text-grey'>Modal No</span><br>
                          <span><?php echo $Vehicle->VehicleModalNo; ?></span>
                        </span>
                      </span>
                      <span class="flex-s-b">
                        <span class='w-100'>
                          <span class='text-grey'>Fuel Type</span><br>
                          <span><?php echo $Vehicle->VehcileFuelType; ?></span>
                        </span>
                        <span class='w-100'>
                          <span class='text-grey'>Max Fuel Capacity</span><br>
                          <span><?php echo $Vehicle->VehicleMaxFuel; ?> L</span>
                        </span>
                        <span class='w-100'>
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
            </a>
          </div>
      <?php }
        $VehicleId = IfRequested('GET', 'ViewFor', $Vehicle->VehicleId, null);
        $ViewMonth = IfRequested('GET', "viewingmonth", date('Y-m'), null);
      } else {
        NoData("No vehicles found!");
        $VehicleId = "";
        $ViewMonth = "";
      }

      $CurrentMonth = date("Y-M");
      $PreviousMonth = date("Y-M", strtotime("-30 days"));
      $CurrentMonthIncome = AMOUNT("SELECT * FROM income where IncomeGroup='$CurrentMonth' and IncomeMainUserId='" . AuthAppUser('UserId') . "'", "IncomeAmount");
      $PreviousMonthIncome = AMOUNT("SELECT * FROM income where IncomeGroup='$PreviousMonth' and IncomeMainUserId='" . AuthAppUser('UserId') . "'", "IncomeAmount");
      $TotalIncome = AMOUNT("SELECT * FROM income where IncomeMainUserId='" . AuthAppUser('UserId') . "'", "IncomeAmount");
      $ExpanseThisMonth = AMOUNT("SELECT * FROM expanses where ExpanseGroup='$CurrentMonth' and ExpanseMainUserId='" . AuthAppUser('UserId') . "'", "ExpanseAmount");
      $ExpansePreviousMonths = AMOUNT("SELECT * FROM expanses where ExpanseGroup='$PreviousMonth' and ExpanseMainUserId='" . AuthAppUser('UserId') . "'", "ExpanseAmount");
      $NetExpanses = AMOUNT("SELECT * FROM expanses where  ExpanseMainUserId='" . AuthAppUser('UserId') . "'", "ExpanseAmount");

      ?>
    </div>
  </section>


  <section class='container'>
    <div class="row">
      <div class='col-md-12'>
        <h5 class='app-heading mt-1'><i class='fa fa-exchange'></i> Expanse Records</h5>
      </div>
      <div class="col mb-2">
        <div class='bg-info p-2'>
          <div class='flex-s-b'>
            <h6 class='mb-1 text-white'><i class='fa fa-arrow-down text-white'></i> All Income</h6>
          </div>
          <div class='bg-light p-2'>
            <p class='mb-0 small'>
              <span>
                <span>
                  <span class='text-gray'>Total Income</span><br>
                  <span class="h6">
                    <?php
                    echo AuthAppUser("UserPriceType");
                    echo Price($TotalIncome); ?>
                  </span>
                </span><br>
                <hr class='mt-1 mb-0'>
                <span class='fs-6'>
                  <span>
                    <span class='text-gray'>In <?php echo date("M"); ?></span><br>
                    <span class='small'>
                      <?php
                      echo AuthAppUser("UserPriceType");
                      echo Price($CurrentMonthIncome); ?>
                    </span>
                  </span><br>
                  <span>
                    <span class='text-gray'>In <?php echo date("M", strtotime("-30 days")); ?></span><br>
                    <span class='small'>
                      <?php
                      echo AuthAppUser("UserPriceType");
                      echo Price($PreviousMonthIncome); ?>
                    </span>
                  </span><br>
                  <span>
                    <span class='text-gray'>Per Day (<?php echo date("M"); ?>)</span><br>
                    <span class='small'>
                      <?php
                      echo AuthAppUser("UserPriceType") . " ";
                      echo $IncomePerDay = round($CurrentMonthIncome / 30, 2); ?></span>
                  </span>
                </span>
              </span>
            </p>
          </div>
        </div>
      </div>

      <div class="col mb-2">
        <div class='bg-warning p-2'>
          <div class='flex-s-b'>
            <h6 class='mb-1 text-white'><i class='fa fa-arrow-up'></i> Net Expanses</h6>
          </div>
          <div class='bg-light p-2'>
            <p class='mb-0 small'>
              <span>
                <span>
                  <span class='text-gray small'>Total Expanses</span><br>
                  <span class="h6">
                    <?php
                    echo AuthAppUser("UserPriceType");
                    echo Price($NetExpanses); ?>
                  </span>
                </span><br>
                <hr class='mt-1 mb-0'>
                <span>
                  <span class='text-gray'>In <?php echo date("M"); ?></span><br>
                  <span class='small'>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    echo Price($ExpanseThisMonth); ?>
                  </span>
                </span><br>
                <span>
                  <span class='text-gray'>In <?php echo date("M", strtotime("-30 days")); ?></span><br>
                  <span class='small'>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    echo Price($ExpansePreviousMonths); ?>
                  </span>
                </span><br>
                <span>
                  <span class='text-gray'>Per Day (<?php echo date("M"); ?>)</span><br>
                  <span class='small'>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    $ExpansePerDay = round($ExpanseThisMonth / 30, 2);
                    echo Price($ExpansePerDay); ?>
                  </span>
                </span>
              </span>
            </p>
          </div>
        </div>
      </div>

      <div class='col-md-12 mb-2'>
        <div class='bg-success p-2'>
          <h6 class='text-white'><i class='fa fa-dashboard'></i> Balance</h6>
          <p class='data-display-2 bg-light mb-0 p-2'>
            <span class='flex-s-b'>
              <span>
                <span class='text-gray'>In <?php echo date('M'); ?></span><br>
                <span>
                  <?php
                  echo AuthAppUser("UserPriceType");
                  echo Price($CurrentMonthBalance = $CurrentMonthIncome - $ExpanseThisMonth); ?>
                </span>
              </span>
              <span>
                <span class='text-gray'>In <?php echo date('M', strtotime("-30 days")); ?></span><br>
                <span>
                  <?php
                  echo AuthAppUser("UserPriceType");
                  echo Price($PreviousMonthIncome - $ExpansePreviousMonths); ?>
                </span>
              </span>
              <span>
                <span class='text-gray'>Per Day (<?php echo date('M'); ?>)</span><br>
                <span>
                  <?php
                  echo AuthAppUser("UserPriceType");
                  echo Price(round($CurrentMonthBalance / 30, 2)); ?>
                </span>
              </span>
              <span>
                <span class='text-gray'>Total Balance</span><br>
                <span>
                  <?php
                  echo AuthAppUser("UserPriceType");
                  echo Price($TotalIncome - $NetExpanses); ?>
                </span>
              </span>
            </span>
          </p>
        </div>
      </div>

    </div>
  </section>

  <section class='container'>
    <div class="row">
      <div class='col-md-12 mt-3'>
        <div class='flex-s-b app-heading'>
          <h6 class='pt-2 m-1 w-100 mt-0'><i class='fa fa-exchange text-primary'></i> Latest Transactions</h6>
          <form class='w-50 mt-1'>
            <input type="month" onchange="form.submit()" name="viewingmonthdsh" class='form-control text-gray p-1' value='<?php echo IfRequested("GET", "viewingmonthdsh", date('Y-m'), null); ?>'>
          </form>
        </div>
      </div>
    </div>

    <div class='row mt-2'>
      <?php
      if (isset($_GET['viewingmonthdsh'])) {
        $TransactionGroup = date("Y-M", strtotime($_GET['viewingmonthdsh']));
        $AllTxn = _DB_COMMAND_("SELECT * FROM transactions where TransactionGroup='$TransactionGroup' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc limit 0, 30", true);
      } else {
        $AllTxn = _DB_COMMAND_("SELECT * FROM transactions where TransactionGroup='" . date('Y-M') . "' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc limit 0, 30", true);
      }
      if ($AllTxn != null) {
        foreach ($AllTxn as $Txn) {
          if ($Txn->TransactionType == "INCOME") {
            $icon = "fa-arrow-down text-success";
          } else {
            $icon = "fa-arrow-up text-danger";
          } ?>
          <div class='col-md-12 mb-1'>
            <a href="expanses.php">
              <div class='app-list-bg txn-list box-shadow p-1'>
                <h6 class='mb-0'>
                  <span class='btn btn-sm list-count'><i class='fa <?php echo $icon; ?>'></i></span> <?php echo AuthAppUser("UserPriceType"); ?><?php echo Price($Txn->TransactionAmount); ?>
                  <span class='text-gray'> @ <?php echo html_entity_decode($Txn->TransactionName); ?></span>
                  <span class='text-gray pull-right p-1 mt-1'><?php echo DATE_FORMATES("d M, Y", $Txn->TransactionDate); ?></span>
                </h6>
              </div>
            </a>
          </div>
      <?php }
      } else {
        NoData("No Transaction Found!");
      } ?>
    </div>
  </section>

  <br><br><br><br><br>
  <?php
  include $Dir . "/include/common/SystemPushAlerts.php";
  include $Dir . "/include/main/Navbar.php";
  include $Dir . "/include/main/Copyrighted.php";
  SystemFooterFiles();
  MainFooterFiles(); ?>
</body>

</html>