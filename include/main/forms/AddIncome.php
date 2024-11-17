<section class="app-data-box hidden" id="AddIncomeEntry">
 <div class="container">
  <div class="row">
   <div class="col-md-12 mt-4">
    <div class="flex-s-b">
     <h4 class="app-heading w-75"><i class='fa fa-exchange text-primary'></i> Add Income</h4>
     <a href="#" onclick="Databar('AddIncomeEntry')" class="p-1 text-danger"><i class="fa fa-times fs-1"></i></a>
    </div>
   </div>
  </div>
  <form class="form" action="<?php echo CONTROLLER("ModuleController/IncomeController.php"); ?>" method="POST">
   <?php FormPrimaryInputs(true, [
    "IncomeMainUserId" => AuthAppUser("UserId"),
   ]); ?>
   <div class="row">
    <div class='flex-s-b mb-2'>
     <div class="form-group w-100 m-1">
      <label>Income Name</label>
      <input type="text" name="IncomeName" placeholder="Like Salary, coupon etc" tabindex="1" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-75 m-1">
      <label>Amount</label>
      <input type="text" name="IncomeAmount" placeholder="<?php echo AuthAppUser('UserPriceType'); ?>" tabindex="1" class="form-control form-control-lg" required="">
     </div>
     <div class="form-group w-50 m-1">
      <label>Date</label>
      <input type="date" value="<?php echo date("Y-m-d"); ?>" name="IncomeReceiveDate" tabindex="1" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="mb-2">
     <div class="form-group w-100 m-1">
      <label>Income Source</label>
      <input type="text" name="IncomeSource" list="IncomeSource" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="mb-2">
     <div class="form-group w-100 m-1">
      <label>Income Tags</label>
      <input type="text" name="IncomeTags" list="IncomeTags" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-100 m-1">
      <label>Add Notes</label>
      <textarea name="IncomeNotes" rows="3" class="form-control form-control-lg"></textarea>
     </div>
    </div>

    <div class="col-md-12 text-center">
     <button type="Submit" name="CreateIncomeEntery" class="btn btn-md system-btn"><i class='fa fa-check'></i> Save Income Entry</button>
    </div>
   </div>
  </form>
 </div>
</section>