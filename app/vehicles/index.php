<?php
$Dir = "../../";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
$PageName = "Profile";
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

  <title>Profile - <?php echo APP_NAME; ?></title>
  <?php include  $Dir . "assets/HeaderFiles.php"; ?>
  <script>
    window.onload = function() {
      document.getElementById("vehicles").classList.add("active");
    }
  </script>
</head>

<body>
  <?php
  include $Dir . "include/Sidebar.php";
  include $Dir . "include/Header.php";
  ?>
  <div class="main main-app p-3 p-lg-4">

    <div class="row g-5">
      <div class="col-md-10 col-7">
        <h2 class="main-title"><i class="ri-user-line"></i> Profile</h2>
      </div>
      <div class="col-md-2 col-5 ">
        <div class="dropdown">
          <a class="dropdown-toggle btn btn-md btn-primary" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Edit Profile <i class='ri-settings-line'></i></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#primaryInfo">Primary Info</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#securityInfo">Login & Security</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row mt-1">
      <div class="col-xl mb-3">
        <div class="media-profile mb-5">
          <div class="media-img mb-3 mb-sm-0">
            <img src="<?php echo AuthAppUser('UserProfileImage'); ?>" class="img-fluid" alt="...">
          </div><!-- media-img -->
          <div class="media-body">
            <h5 class="media-name"><?php echo AuthAppUser('UserFullName'); ?></h5>
            <p class="d-flex gap-1 mb-2 text-secondary"><i class="ri-information-line"></i> <?php echo AuthAppUser("UserRole"); ?>, <?php echo AuthAppUser('UserDisplayName'); ?></p>
            <p class="mb-0">
              <span><i class='ri-phone-line'></i> <?php echo AuthAppUser('UserPhoneNumber'); ?></span><br>
              <span><i class='ri-mail-line'></i> <?php echo AuthAppUser('UserEmailId'); ?></span><br>
            </p>
            <p>
              <span><i class="ri-map-pin-2-line"></i></span>
              <span>
                <?php
                $AddressFields = [
                  "UserStreetAddress", "UserAddressBlock", "UserAddressBlock", "UserNearByLocation", "UserCity", "UserState", "UserCountry", "UserPincode"
                ];
                foreach ($AddressFields as $Address) {
                  echo UserAddress(LOGIN_USER_ID, "$Address") . " ";
                }
                ?>
              </span>
            </p>
          </div><!-- media-body -->
        </div><!-- media-profile -->

        <div class="row row-cols-sm-auto g-4 g-md-5 g-xl-4 g-xxl-5">
          <div class="col">
            <div class="profile-item">
              <i class="ri-medal-2-line"></i>
              <div class="profile-item-body">
                <p>5 Certificates</p>
                <span>Achievements</span>
              </div><!-- profile-item-body -->
            </div><!-- profile-item -->
          </div><!-- col -->
          <div class="col">
            <div class="profile-item">
              <i class="ri-suitcase-line"></i>
              <div class="profile-item-body">
                <p>10+ Years</p>
                <span>Experience</span>
              </div><!-- profile-item-body -->
            </div><!-- profile-item -->
          </div><!-- col -->
          <div class="col">
            <div class="profile-item">
              <i class="ri-team-line"></i>
              <div class="profile-item-body">
                <p>356</p>
                <span>Following</span>
              </div><!-- profile-item-body -->
            </div><!-- profile-item -->
          </div><!-- col -->
          <div class="col">
            <div class="profile-item">
              <i class="ri-team-line"></i>
              <div class="profile-item-body">
                <p>1,056</p>
                <span>Followers</span>
              </div><!-- profile-item-body -->
            </div><!-- profile-item -->
          </div><!-- col -->
        </div><!-- row -->


      </div><!-- col -->
    </div><!-- row -->

  </div>


  <?php

  include $Dir . "assets/FooterFiles.php";
  ?>

</body>

</html>