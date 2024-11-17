<h6><i class="fa fa-refresh text-success"></i> Verify Account</h6>
<div>
 <form action="<?php echo CONTROLLER('AuthController/AuthController.php'); ?>" method="POST">
  <?php FormPrimaryInputs(true); ?>
  <div class="form-group mb-3 mt-4">
   <p>Enter your registered email-id.</p>
   <input type="text" name="UserEmailId" value="<?php echo IfRequested("GET", "UserEmailId", "", null); ?>" class="form-control form-control-lg" placeholder="Enter Registered Main-ID">
  </div>
  <div class="flex-s-b">
   <button type="submit" class="btn btn-lg system-btn pull-right" name="SearchAccountForPasswordReset"><i class="fa fa-check on"></i> Verify Account</button>
  </div>

  <div class="flex-s-b mb-3 mt-5">
   <a href="index.php" class="p-1">Know Password? Login Now</a>
  </div>
 </form>
</div>