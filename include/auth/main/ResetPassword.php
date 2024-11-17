<h6><i class="fa fa-edit text-success"></i> Change Your Password</h6>
<?php if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $for = SECURE($_GET['for'], "d");

  $CheckTokenisations = CHECK("SELECT * FROM user_password_change_requests where PasswordChangeToken='$token'");
  if ($CheckTokenisations == null) { ?>
    <div class="p-2">
      <h4 class="mb-3 text-center"><span class="text-warning">OOoopsss...</span></h4>
      <h5 class="text-center">Invalid Token Received</h5>
      <a href="index.php" class="btn btn-md system-btn"><i class="fa fa-angle-left"></i> Back to Login Page</a>
    </div>
    <?php } else {
    $ValidateTokenForUser = CHECK("SELECT * FROM user_password_change_requests where PasswordChangeToken='$token' and UserIdForPasswordChange='$for'");
    if ($ValidateTokenForUser == null) { ?>
      <div class="p-2">
        <h4 class="mb-3 text-center"><span class="text-warning">OOoopsss...</span></h4>
        <h5 class="text-center">Invalid Token Access Found!</h5>
        <a href="index.php" class="btn btn-md system-btn"><i class="fa fa-angle-left"></i> Back to Login Page</a>
      </div>
    <?php } else {
      $_SESSION['REQUESTED_EMAIL_ID'] = $for;
      $_SESSION['PASSWORD_RESET_TOKEN'] = $token; ?>
      <div>
        <form action="<?php echo CONTROLLER('AuthController/AuthController.php'); ?>" method="POST">
          <?php FormPrimaryInputs(true); ?>
          <p class="bg-success text-white p-2 rounded-2"><i class="fa fa-check"></i> Password Change Token verified Successfully!</p>
          <div class="form-group mb-3">
            <label>Enter New Password</label>
            <input type="password" name="Password1" class="form-control form-control-lg" placeholder="***********">
          </div>
          <div class="form-group mb-4">
            <label>Re-Enter Password</label>
            <input type="password" name="Password2" class="form-control form-control-lg" placeholder="***********">
          </div>
          <div class="flex-s-b mt-3">
            <button type="submit" class="btn btn-md system-btn pull-right" name="RequestForPasswordChange"><i class="fa fa-power-off on"></i> Change Password</button>
          </div>
        </form>
      </div>
  <?php }
  }
} else { ?>
  <div>
    <h3 class="mb-3 text-center"><i class="fa fa-warning text-warning"></i> No Access Token Found!</h3>
    <a href="index.php" class="btn btn-md system-btn"><i class="fa fa-angle-left"></i> Back to Login Page</a>
  </div>
<?php } ?>