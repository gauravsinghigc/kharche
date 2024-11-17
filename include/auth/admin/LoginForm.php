<h6 class="text-center"><i class="fa fa-power-off text-success"></i> Login into System</h6>
<div class="p-2">
 <form action="<?php echo CONTROLLER('AuthController/AuthController.php'); ?>" method="POST">
  <?php FormPrimaryInputs(true); ?>
  <div class="form-group mb-3">
   <label>Enter Registered Email-id</label>
   <input type="text" name="UserEmailId" class="form-control form-control-lg" placeholder="Enter Registered Main-ID">
  </div>
  <div class="form-group mb-2">
   <label>Enter Password</label>
   <input type="password" name="UserPassword" class="form-control form-control-lg" placeholder="***********">
  </div>
  <div class="flex-s-b mb-3">
   <a href="?password-reset=true&view=Recover Password">Recover Password</a>
   <a href="#"><i class="fa fa-eye"></i> View Password</a>
  </div>
  <div class="flex-s-b">
   <button type="submit" class="btn btn-md system-btn pull-right" name="LoginRequest"><i class="fa fa-power-off on"></i> Secure login</button>
   <a href="?sign-up=true" class="btn btn-md btn-white">Sign Up</a>
  </div>
 </form>
</div>