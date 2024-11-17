<div>
 <p><i class='fa fa-check text-success'></i> Create an Account</p>
 <form action="<?php echo CONTROLLER('ModuleController/UserController.php'); ?>" method="POST">
  <?php FormPrimaryInputs(true); ?>
  <div class="form-group mb-2">
   <input type="text" name="UserFullName" class="form-control" placeholder="Full Name">
  </div>
  <div class="form-group mb-2">
   <input type="tel" name="UserPhoneNumber" class="form-control" placeholder="Phone number">
  </div>
  <div class="form-group mb-2">
   <input type="email" name="UserEmailId" class="form-control" placeholder="Email Id">
  </div>
  <div class="form-group mb-2">
   <input type="password" name="UserPassword" class="form-control" placeholder="* * * * * *">
  </div>
  <div class="form-group mb-2">
   <select name="UserGender" class="form-control" required="">
    <?php InputOptions(['Male', "Female", "Others", "Select Gender"], "Select Gender"); ?>
   </select>
  </div>
  <div class="form-group mb-4">
   <select name="UserPriceType" class="form-control" required="">
    <?php InputOptions([
     "₹", "$", "€", "£", "د.ك"
    ]); ?>
   </select>
  </div>
  <div class="form-group mb-3">
   <p><i class="fa fa-check-circle text-success"></i> By continue this you agree our <a href="<?php echo WEB_URL; ?>/privacy-policy.php" class='text-primary'>Privacy Policy</a> and <a href="<?php echo WEB_URL; ?>/tnc.php" class='text-primary'>Terms and Conditions</a></p>
  </div>
  <div class=" text-left w-100">
   <button type="submit" class="btn btn-md system-btn sys-app-btn" name="CreateAccount">Create Account <i class="fa fa-power-off on"></i></button>
  </div>
  <div class="mt-4 w-100 text-left">
   <a href="index.php" class="text-grey">Have an Account? Login Now</a>
  </div>
 </form>
</div>