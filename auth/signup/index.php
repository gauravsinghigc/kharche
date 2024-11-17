<?php
$Dir = "../..";
require $Dir . "/acm/SysFileAutoLoader.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Meta -->
  <meta name="description" content="">
  <meta name="author" content="<?php echo APP_NAME; ?>">

  <title>Create an account @ <?php echo APP_NAME; ?></title>
  <?php include $Dir . "/assets/HeaderFiles.php"; ?>
</head>

<body class="page-sign d-block py-0" style="background-image:url('<?php echo LOGIN_BG_IMAGE; ?>') !important;background-size:cover;background-repeat:no-repeat;">

  <div class="row g-0">
    <div class="col-md-7 col-lg-5 col-xl-4 col-wrapper">
      <div class="card card-sign">
        <div class="card-header">
          <a href="<?php echo DOMAIN; ?>" class="header-logo mb-4">
            <img src="<?php echo APP_LOGO; ?>" class='img-fluid w-50'>
          </a>
          <h3 class="card-title">Create Account</h3>
          <p class="card-text">Don't have account? Create an account.</p>
        </div><!-- card-header -->
        <div class="card-body">
          <form action="<?php echo CONTROLLER; ?>/ModuleController/UserController.php" method="POST">
            <?php FormPrimaryInputs(true); ?>
            <div class="mb-3">
              <label class="form-label">Full Name</label>
              <input type="text" name="UserFullName" class="form-control" placeholder="Enter Full name">
            </div>
            <div class="mb-3">
              <label class="form-label">Phone Number <span id='phonemsg'></span></label>
              <input type="tel" name="UserPhoneNumber" oninput="CheckExistingPhoneNumbers()" id="PhoneNumber" class="form-control" placeholder="+91">
            </div>
            <div class="mb-3">
              <label class="form-label">Email address <span id='emailmsg'></span></label>
              <input type="email" name="UserEmailId" oninput="CheckExistingMailId()" id="EmailId" class="form-control" placeholder="Enter your email address">
            </div>
            <div class="mb-4">
              <label class="form-label">Password</label>
              <input type="password" min="8" name="UserPassword" class="form-control" placeholder="* * * * * *">
            </div>
            <button type="submit" id="subbtn" name="CreateAccount" class="btn btn-primary btn-sign">Create Account</button>
          </form>
        </div><!-- card-body -->
        <div class="card-footer justify-content-around">
          Already have an account? <a href="<?php echo ROOT; ?>/auth/login/">Login Now</a>
          <div class="divider">
          </div>
          <?php include $Dir . "/include/others/AuthFooter.php"; ?>
        </div><!-- card-footer -->
      </div><!-- card -->
    </div><!-- col -->
  </div><!-- row -->

  <script>
    function CheckExistingPhoneNumbers() {
      let SearchingFor = document.getElementById("PhoneNumber");
      var phonemsg = document.getElementById("phonemsg");
      var pattern = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
      var subbtn = document.getElementById("subbtn");
      let ExistingPhoneNumbers = [<?php
                                  $AllData = _DB_COMMAND_("SELECT * FROM users", true);
                                  if ($AllData != null) {
                                    foreach ($AllData as $Data) {
                                      echo "'" . $Data->UserPhoneNumber . "', ";
                                    }
                                  } ?>];

      if (ExistingPhoneNumbers.includes(SearchingFor.value)) {
        phonemsg.classList.add("text-danger");
        phonemsg.classList.remove("text-warning");
        phonemsg.innerHTML = "<i class='fa fa-warning'></i> Phone Number Already Exits";
        subbtn.type = "button";
      } else if (pattern.test(SearchingFor.value) == false) {
        phonemsg.classList.add("text-warning");
        phonemsg.classList.remove("text-danger");
        phonemsg.innerHTML = "<i class='fa fa-warning'></i> Phone Number is not valid";
        subbtn.type = "button";
      } else {
        phonemsg.classList.remove("text-danger");
        phonemsg.classList.remove("text-warning");
        phonemsg.classList.add("text-success");
        phonemsg.innerHTML = "<i class='fa fa-check'></i> Phone Number is Ok";
        subbtn.type = "submit";
      }
    }

    function CheckExistingMailId() {
      let SearchingFor = document.getElementById("EmailId");
      var emailmsg = document.getElementById("emailmsg");
      var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
      var subbtn = document.getElementById("subbtn");
      let CheckExistingMailId = [<?php
                                  $AllData = _DB_COMMAND_("SELECT * FROM users", true);
                                  if ($AllData != null) {
                                    foreach ($AllData as $Data) {
                                      echo "'" . $Data->UserEmailId . "', ";
                                    }
                                  } ?>];

      if (CheckExistingMailId.includes(SearchingFor.value)) {
        emailmsg.classList.add("text-danger");
        emailmsg.classList.remove("text-warning");
        emailmsg.innerHTML = "<i class='fa fa-warning'></i> Email-Id Already Exits";
        subbtn.type = "button";
      } else if (pattern.test(SearchingFor.value) == false) {
        emailmsg.classList.add("text-warning");
        emailmsg.classList.remove("text-danger");
        emailmsg.innerHTML = "<i class='fa fa-warning'></i> Email-ID is not valid";
        subbtn.type = "button";
      } else {
        emailmsg.classList.remove("text-danger");
        emailmsg.classList.remove("text-warning");
        emailmsg.classList.add("text-success");
        emailmsg.innerHTML = "<i class='fa fa-check'></i> Email-ID is Ok";
        subbtn.type = "submit";
      }
    }
  </script>
  <?php
  include $Dir . "/assets/FooterFiles.php"; ?>
</body>

</html>