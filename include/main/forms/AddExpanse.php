<section class="app-data-box hidden" id="AddExpanseEntry">
 <div class="container">
  <div class="row">
   <div class="col-md-12 mt-4">
    <div class="flex-s-b">
     <h4 class="app-heading w-75"><i class='fa fa-exchange text-primary'></i> Add Expanse</h4>
     <a href="#" onclick="Databar('AddExpanseEntry')" class="p-1 text-danger"><i class="fa fa-times fs-1"></i></a>
    </div>
   </div>
  </div>
  <form class="form" action="<?php echo CONTROLLER("ModuleController/ExpanseController.php"); ?>" method="POST">
   <?php FormPrimaryInputs(true, [
    "ExpanseMainUserId" => AuthAppUser("UserId"),
   ]); ?>
   <div class="row">
    <div class="flex-s-b mb-2">
     <div class="form-group w-100 m-1">
      <label>Expanse Name</label>
      <input type="text" name="ExpanseName" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-75 m-1">
      <label>Spent Amount</label>
      <input type="text" name="ExpanseAmount" placeholder="<?php echo AuthAppUser('UserPriceType'); ?>" tabindex="1" class="form-control form-control-lg" required="">
     </div>
     <div class="form-group w-50 m-1">
      <label>Date</label>
      <input type="date" value="<?php echo date("Y-m-d"); ?>" name="ExpanseDate" tabindex="1" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-100 m-1">
      <label>Expanse Category</label>
      <input type="text" name="ExpanseCategory" list="ExpanseCategory" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-100 m-1">
      <label>Expanse Tags</label>
      <input type="text" name="ExpanseTags" list="ExpanseTags" class="form-control form-control-lg" required="">
     </div>
    </div>
    <div class="flex-s-b mb-2">
     <div class="form-group w-100 m-1">
      <label>Add Notes</label>
      <textarea name="ExpanseNotes" rows="3" class="form-control form-control-lg"></textarea>
     </div>
    </div>

    <div class="col-md-12 text-center">
     <button type="Submit" name="CreateExpanseEntery" class="btn btn-md system-btn"><i class='fa fa-check'></i> Save Expanse Entry</button>
    </div>
   </div>
  </form>
 </div>
</section>