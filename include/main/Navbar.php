<section class="app-btm-navbar">
 <div class="container p-1">
  <div class="col-md-12">
   <div class="bg-primary rounded p-1">
    <div class="flex-s-b">
     <a href="index.php" id="home">
      <i class='fa fa-home'></i><br>
      <span>Home</span>
     </a>
     <a href="expanses.php" id="expanses">
      <i class='fa fa-exchange'></i><br>
      <span>Transactions</span>
     </a>
     <a class='plus-button text-black' id='View' onclick="ActivityStart()">
      <i class='fa fa-plus text-black'></i>
     </a>
     <a class='bg-danger text-white' style='display:none;font-size:1.46em;width:30%;' id="Close" onclick="ActivityStart()">
      <i class='fa fa-times text-white'></i>
     </a>
     <a href="fuel.php" id="vehicles">
      <i class='fa fa-gas-pump'></i><br>
      <span>Fillings</span>
     </a>
     <a href="account.php" id="account">
      <img src="<?php echo AuthAppUser("UserProfileImage"); ?>" class="mx-auto d-block rounded" style="border-radius:100% !important;width:1em !important;height;1em !important;">
      <span>Account</span>
     </a>
    </div>
   </div>
  </div>
 </div>
</section>

<section class='entry-button bg-white' id="ViewAddButtons">
 <div class='flex-s-b w-100'>
  <a onclick="Databar('AddFuelEntry')" class="btn btn-sm system-btn"><i class="fa fa-plus"></i> Fillings</a>
  <a onclick="Databar('AddExpanseEntry')" class="btn btn-sm system-btn"><i class="fa fa-plus"></i> Expanse</a>
  <a onclick="Databar('AddIncomeEntry')" class="btn btn-sm system-btn"><i class="fa fa-plus"></i> Income</a>
  <a onclick="Databar('AddVehicle')" class="btn btn-sm system-btn"><i class="fa fa-plus"></i> Vehicle</a>
 </div>
</section>