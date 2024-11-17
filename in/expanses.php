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
$PageName = IfRequested("GET", "view", "All Transactions", false);
$ViewMonth = IfRequested("GET", "viewingmonth", date("Y-m"), false);
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
      document.getElementById("expanses").classList.add("active");
    }
    window.onload = SidebarActive;
  </script>
</head>

<body>
  <header class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="flex-s-b">
          <div class="w-100 text-left">
            <h6 class='text-black text-capitalize shadow-sm rounded p-2 mt-2'><i class='fa fa-exchange text-primary'></i> <?php echo $PageName; ?></h6>
          </div>
          <div class="w-50 m-l-5 text-right">
            <img src="<?php echo APP_LOGO; ?>" class="img-fluid app-header-logo">
          </div>
        </div>
      </div>
    </div>
  </header>

  <section class='container'>
    <div class="row">
      <div class="col-md-12 mb-2">
        <div class='bg-info p-2'>
          <div class='flex-s-b'>
            <h6 class='mb-1 text-white'><i class='fa fa-arrow-down text-white'></i> Net Income</h6>
          </div>
          <div class='bg-light p-2'>
            <p class='data-display-2 mb-0'>
              <span class='flex-s-b'>
                <span>
                  <span class='text-gray'>In <?php echo date("M"); ?></span><br>
                  <span>
                    <?php
                    $CurrentMonth = date("Y-M");
                    echo AuthAppUser("UserPriceType");
                    $CurrentMonthIncome = AMOUNT("SELECT * FROM income where IncomeGroup='$CurrentMonth' and IncomeMainUserId='" . AuthAppUser('UserId') . "'", "IncomeAmount");
                    echo Price($CurrentMonthIncome); ?>
                  </span>
                </span>
                <span>
                  <span class='text-gray'>In <?php echo date("M", strtotime("-30 days")); ?></span><br>
                  <span>
                    <?php
                    $PreviousMonth = date("Y-M", strtotime("-30 days"));
                    echo AuthAppUser("UserPriceType");
                    $PreviousMonthIncome = AMOUNT("SELECT * FROM income where IncomeGroup='$PreviousMonth' and IncomeMainUserId='" . AuthAppUser('UserId') . "'", "IncomeAmount");
                    echo Price($PreviousMonthIncome); ?>
                  </span>
                </span>
                <span>
                  <span class='text-gray'>Per Day (<?php echo date("M"); ?>)</span><br>
                  <span>
                    <?php
                    echo AuthAppUser("UserPriceType") . " ";
                    echo $IncomePerDay = round($CurrentMonthIncome / 30, 2); ?></span>
                </span>
                <span>
                  <span class='text-gray'>Total Income</span><br>
                  <span>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    $TotalIncome = AMOUNT("SELECT * FROM income where IncomeMainUserId='" . AuthAppUser('UserId') . "'", "IncomeAmount");
                    echo Price($TotalIncome); ?>
                  </span>
                </span>
              </span>
            </p>
          </div>
        </div>
      </div>


      <div class="col-md-12 mb-2">
        <div class='bg-warning p-2'>
          <div class='flex-s-b'>
            <h6 class='mb-1 text-white'><i class='fa fa-arrow-up'></i> Net Expanses</h6>
          </div>
          <div class='bg-light p-2'>
            <p class='data-display-2 mb-0'>
              <span class='flex-s-b'>
                <span>
                  <span class='text-gray'>In <?php echo date("M"); ?></span><br>
                  <span>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    $ExpanseThisMonth = AMOUNT("SELECT * FROM expanses where ExpanseGroup='$CurrentMonth' and ExpanseMainUserId='" . AuthAppUser('UserId') . "'", "ExpanseAmount");
                    echo Price($ExpanseThisMonth); ?>
                  </span>
                </span>
                <span>
                  <span class='text-gray'>In <?php echo date("M", strtotime("-30 days")); ?></span><br>
                  <span>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    $ExpansePreviousMonths = AMOUNT("SELECT * FROM expanses where ExpanseGroup='$PreviousMonth' and ExpanseMainUserId='" . AuthAppUser('UserId') . "'", "ExpanseAmount");
                    echo Price($ExpansePreviousMonths); ?>
                  </span>
                </span>
                <span>
                  <span class='text-gray'>Per Day (<?php echo date("M"); ?>)</span><br>
                  <span>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    $ExpansePerDay = round($ExpanseThisMonth / 30, 2);
                    echo Price($ExpansePerDay); ?>
                  </span>
                </span>

                <span>
                  <span class='text-gray'>Total Expanses</span><br>
                  <span>
                    <?php
                    echo AuthAppUser("UserPriceType");
                    $NetExpanses = AMOUNT("SELECT * FROM expanses where  ExpanseMainUserId='" . AuthAppUser('UserId') . "'", "ExpanseAmount");
                    echo Price($NetExpanses); ?>
                  </span>
                </span>
              </span>
            </p>
          </div>
        </div>
      </div>

      <div class='col-md-12'>
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
        <div class='flex-s-b'>
          <h6 class='p-1 m-1 w-100'><i class='fa fa-exchange text-primary'></i> Transaction History</h6>
          <form class='w-50'>
            <input type="hidden" name="ViewFor" value="<?php echo $ViewMonth; ?>">
            <input type="month" onchange="form.submit()" name="viewingmonth" class='form-control form-control-sm' value='<?php echo IfRequested("GET", "viewingmonth", date('Y-m'), null); ?>'>
          </form>
        </div>
      </div>
    </div>

    <div class='row mt-2'>
      <?php
      if (isset($_GET['viewingmonth'])) {
        $TransactionGroup = date("Y-M", strtotime($_GET['viewingmonth']));
        $AllTxn = _DB_COMMAND_("SELECT * FROM transactions where TransactionGroup='$TransactionGroup' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc", true);
      } else {
        $AllTxn = _DB_COMMAND_("SELECT * FROM transactions where TransactionGroup='" . date('Y-M') . "' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc", true);
      }
      if ($AllTxn != null) { ?>
        <div class='col-md-12 mb-2'>
          <div class='flex-s-b'>
            <div class='w-100 m-1'>
              <div class='bg-white txn-list box-shadow p-1'>
                <h6 class='mb-0'>
                  <?php
                  if (isset($_GET['viewingmonth'])) {
                    $TransactionGroup = date("Y-M", strtotime($_GET['viewingmonth']));
                    $AllExpanses = AMOUNT("SELECT * FROM transactions where TransactionType='INCOME' and TransactionGroup='$TransactionGroup' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc", "TransactionAmount");
                  } else {
                    $AllExpanses = AMOUNT("SELECT * FROM transactions where  TransactionType='INCOME' and TransactionGroup='" . date('Y-M') . "' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc", "TransactionAmount");
                  } ?>
                  <span class='btn btn-sm list-count'><i class='fa fa-arrow-down text-success'></i></span> <?php echo AuthAppUser("UserPriceType"); ?><?php echo Price($AllExpanses); ?>
                </h6>
              </div>
            </div>
            <div class='w-100 m-1'>
              <div class='bg-white txn-list box-shadow p-1'>
                <h6 class='mb-0'>
                  <?php
                  if (isset($_GET['viewingmonth'])) {
                    $TransactionGroup = date("Y-M", strtotime($_GET['viewingmonth']));
                    $AllIncome = AMOUNT("SELECT * FROM transactions where TransactionType='EXPANSE' and TransactionGroup='$TransactionGroup' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc", "TransactionAmount");
                  } else {
                    $AllIncome = AMOUNT("SELECT * FROM transactions where  TransactionType='EXPANSE' and TransactionGroup='" . date('Y-M') . "' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc", "TransactionAmount");
                  } ?>
                  <span class='btn btn-sm list-count'><i class='fa fa-arrow-up text-danger'></i></span> <?php echo AuthAppUser("UserPriceType"); ?><?php echo Price($AllIncome); ?>
                </h6>
              </div>
            </div>
          </div>
          <div class='flex-s-b'>
            <div class='w-100 m-1'>
              <div class='bg-white txn-list box-shadow p-1'>
                <h6 class='mb-0'>
                  <span class='btn btn-sm list-count'><i class='fa fa-inr text-success'></i></span> <?php echo AuthAppUser("UserPriceType"); ?> <?php echo Price($AllExpanses - $AllIncome); ?>
                </h6>
              </div>
            </div>
            <div class='w-100 m-1'>
              <div class='bg-white txn-list box-shadow p-1'>
                <h6 class='mb-0'>
                  <?php
                  if (isset($_GET['viewingmonth'])) {
                    $TransactionGroup = date("Y-M", strtotime($_GET['viewingmonth']));
                    $TotalTxn = TOTAL("SELECT * FROM transactions where TransactionGroup='$TransactionGroup' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc");
                  } else {
                    $TotalTxn = TOTAL("SELECT * FROM transactions where TransactionGroup='" . date('Y-M') . "' and TransactionMainUserId='" . AuthAppUser('UserId') . "' order by TransactionId desc");
                  } ?>
                  <span class='btn btn-sm list-count'><i class='fa fa-exchange text-black'></i></span> <?php echo $TotalTxn; ?> Txns
                </h6>
              </div>
            </div>
          </div>
        </div>
        <?php
        foreach ($AllTxn as $Txn) {
          if ($Txn->TransactionType == "INCOME") {
            $icon = "fa-arrow-down text-success";
            $page = "income-edit";
          } else {
            $icon = "fa-arrow-up text-danger";
            $page = "expanse-edit";
          } ?>
          <div class='col-md-12 mb-1'>
            <a href="<?php echo $page; ?>.php?id=<?php echo SECURE($Txn->TransactionMainRefId, "e"); ?>">
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
  <br><br><br><br><br><br><br><br>
  <?php
  include $Dir . "/include/common/SystemPushAlerts.php";
  include $Dir . "/include/main/Navbar.php";
  include $Dir . "/include/main/Copyrighted.php";
  SystemFooterFiles();
  MainFooterFiles(); ?>
</body>

</html>