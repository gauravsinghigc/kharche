<h6 class="text-center"><i class="fa fa-refresh text-success"></i> Recover Password</h6>
<div class="p-2">
 <form action="<?php echo CONTROLLER('AuthController/AuthController.php'); ?>" method="POST">
  <?php FormPrimaryInputs(true); ?>
  <div class="form-group mb-3">
   <p>Enter your registered email-id, we will send password reset link on it.</p>
   <label>Enter Registered Email-id</label>
   <input type="text" name="UserEmailId" value="" class="form-control form-control-lg" placeholder="Enter Registered Main-ID">
  </div>
  <div class="flex-s-b">
   <button type="submit" class="btn btn-md system-btn pull-right" name="SearchAccountForPasswordReset"><i class="fa fa-search on"></i> Search Account</button>
  </div>

  <div class="flex-s-b mb-3 mt-3">
   <a href="index.php" class="p-1">Know Password? Login Now</a>
   <a href="?sign-up=true&view=Create An Account" class="btn btn-md btn-white">Sign Up</a>
  </div>
 </form>
</div>