<section class="app-data-box hidden" id="AddVehicle">
 <div class="container">
  <div class="row">
   <div class="col-md-12 mt-4">
    <div class="flex-s-b">
     <h4 class="app-heading w-75"><i class='fa fa-truck text-primary'></i> Add Vehicle</h4>
     <a href="#" onclick="Databar('AddVehicle')" class="p-1 text-danger"><i class="fa fa-times fs-1"></i></a>
    </div>
   </div>
  </div>
  <form class="form" action="<?php echo CONTROLLER("ModuleController/VehicleController.php"); ?>" method="POST">
   <?php FormPrimaryInputs(true, [
    "MainUserId" => AuthAppUser("UserId"),
   ]); ?>
   <div class="row">
    <div class="flex-s-b mb-1">
     <div class="form-group w-75 m-1">
      <label>Vehicle Name</label>
      <input type="text" name="VehcileName" tabindex="1" class="form-control form-control-lg" required="">
     </div>
     <div class="form-group w-50 m-1">
      <label>Brand Name</label>
      <input type="text" name="VehicleBrandName" list="VehicleBrandName" class="form-control form-control-lg" required="">
      <?php SUGGEST("vehicles", "VehicleBrandName", "ASC"); ?>
     </div>
    </div>
    <div class="flex-s-b mb-1">
     <div class="form-group w-50 m-1">
      <label>Vehicle Type</label>
      <select name="VehcileType" class="form-control form-control-lg" required>
       <?php InputOptions(['Truck', "Car", "Bike", "SUV"]) ?>
      </select>
     </div>
     <div class="form-group w-50 m-1">
      <label>Fuel Type</label>
      <select name="VehcileFuelType" class="form-control form-control-lg" required>
       <?php InputOptions(['Petrol', "Diesel", "Gasoline", "CNG/Petrol", "CNG", "BioFuel", "Electric"]); ?>
      </select>
     </div>
    </div>
    <div class="flex-s-b mb-1">
     <div class="form-group w-50 m-1">
      <label>Modal Name</label>
      <input type="text" name="VehicleModalNo" list="VehicleModalNo" class="form-control form-control-lg" required="">
      <?php SUGGEST("vehicles", "VehicleModalNo", "ASC"); ?>
     </div>
     <div class="form-group w-50 m-1">
      <label>Reg No</label>
      <input type="text" name="VehicleRegNo" class="form-control text-capitalize text-uppercase form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-1">
     <div class="form-group w-75 m-1">
      <label>Engine No</label>
      <input type="text" name="VehicleEngineNo" class="form-control text-capitalize text-uppercase form-control-lg">
     </div>
     <div class="form-group w-50 m-1">
      <label>Fuel Tank</label>
      <input type="number" min='1' name="VehicleMaxFuel" placeholder="10 L" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-1">
     <div class="form-group w-100">
      <label>Chassis No</label>
      <input type="" name="VehicleChasisNo" class="form-control text-capitalize text-uppercase form-control-lg">
     </div>
    </div>

    <div class="col-md-12 text-center">
     <button type="Submit" name="CreateVehicleDetails" class="btn btn-md system-btn"><i class='fa fa-check'></i> Save Vehicle Details</button>
    </div>
   </div>
  </form>
 </div>
</section>