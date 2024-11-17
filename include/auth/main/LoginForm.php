<div>
 <p><i class='fa fa-lock text-success'></i> Login Into into <?php echo APP_NAME; ?></p>
 <form action="<?php echo CONTROLLER('AuthController/AuthController.php'); ?>" method="POST">
  <?php FormPrimaryInputs(true); ?>
  <div class="form-group mb-3">
   <input type="text" name="UserEmailId" class="form-control" placeholder="Enter Registered Main-ID">
  </div>
  <div class="form-group mb-3">
   <input type="password" name="UserPassword" class="form-control" placeholder="***********">
  </div>
  <div class="w-100 text-left mt-1">
   <a href="?password-reset=true&view=Recover Password" class="p-1"><i class='fa fa-refresh text-grey'></i> Recover Password</a><br>
  </div>
  <div class="text-left w-100">
   <button type="submit" class="btn btn-sm system-btn sys-app-btn mt-4" name="LoginRequest"><i class="fa fa-power-off on"></i> Secure login</button>
  </div>

  <div class="mt-4 w-100 text-left">
   <a href="?sign-up=true" class="text-grey">Create an account</a>
  </div>
 </form>
</div>