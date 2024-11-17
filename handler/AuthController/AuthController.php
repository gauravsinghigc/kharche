<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";

//admin login request
if (isset($_POST['LoginRequest'])) {
 $UserPassword = $_POST['UserPassword'];
 $UserEmailId = $_POST['UserEmailId'];
 $CheckUsername = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId' and UserPassword='$UserPassword'");

 if ($CheckUsername == true) {
  //get user details
  $Sql = "SELECT * FROM users where UserEmailId='$UserEmailId' and UserLoginStatus='true'";
  $UserId = FETCH($Sql, "UserId");
  $UserFullName = FETCH($Sql, "UserFullName");
  $UserRole = FETCH($Sql, "UserRole");

  GENERATE_APP_LOGS("CP_SUCCESS", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d",), "LOGIN");
  //open application as per ui
  //admin
  if ($UserRole == "SUPER_ADMIN") {
   $_SESSION['SYSTEM_LOGIN_USER_ID'] = $UserId;
   setcookie("SYSTEM_LOGIN_USER_ID", $UserId, time() + 60 * 60 * 365);
   LOCATION("success", "Welcome $UserName, Login Successful!", DOMAIN . "/sys/index.php");

   //app user
  } elseif ($UserRole == "APP_USER") {
   $_SESSION['APP_LOGIN_USER_ID'] = $UserId;
   setcookie("APP_LOGIN_USER_ID", $UserId, time() + 60 * 60 * 365);
   LOCATION("success", "Welcome $UserName, Login Successful!", DOMAIN . "/in/index.php");
  }
 } else {
  GENERATE_APP_LOGS("CP_BLOCK", "New Login Received @ User : " . $UserEmailId . ", Pass : " . SECURE($UserPassword, "d"), "LOGIN");
  LOCATION("warning", "Please check your Email-Id and Password. They are incorrect, Please try again with valid Email-ID and Password!", "$access_url");
 }

 //web login handler
} else if (isset($_POST['WebLoginRequest'])) {
 $CustomerPassword = $_POST['CustomerPassword'];
 $CustomerEmailid = $_POST['CustomerEmailid'];

 $Check = CHECK("SELECT * FROM customers where CustomerEmailid='$CustomerEmailid' and CustomerPassword='$CustomerPassword'");
 if ($Check == true) {
  $CustomerId = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerEmailid' and CustomerPassword='$CustomerPassword'", "CustomerId");
  $_SESSION['LOGIN_CustomerId'] = $CustomerId;
  MSG("success", "Login Successfull!");

  LOCATION("success", "Login Successfull $wishlistmsg", $access_url);
 } else {
  LOCATION("warning", "Invalid Email-id & Password", $access_url);
 }

 //recover account
} else if (isset($_POST['submitted_data'])) {
 $Receiveddata = $_POST['submitted_data'];
 $Checkifitisphonenumber = CHECK("SELECT * FROM customers where CustomerEmailid='$Receiveddata'");
 if ($Checkifitisphonenumber == true) {
  $CustomerEmailid = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerEmailid');
  $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerName');
  $CustomerId = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", "CustomerId");

  $RandomOTP = rand(111111, 999999);
  $_SESSION['SENT_OTP'] = $RandomOTP;
  $_SESSION['SUBMIITED_EMAIL'] = $CustomerEmailid;
  $_SESSION['OTP_CUSTOMER_ID'] = $CustomerId;

  SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
  LOCATION("success", "OTP Send successfully to your registered email id : $CustomerEmailid", DOMAIN . "/auth/web/verify/");
 } else {
  $CheckifitisEmailID = CHECK("SELECT * FROM customers where CustomerEmailid='$Receiveddata'");
  if ($CheckifitisEmailID == true) {
   $CustomerEmailid = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerEmailid');
   $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$Receiveddata'", 'CustomerName');
   $CustomerId = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerPhoneNumber'", "CustomerId");

   $RandomOTP = rand(111111, 999999);
   $_SESSION['SENT_OTP'] = $RandomOTP;
   $_SESSION['SUBMIITED_EMAIL'] = $CustomerEmailid;
   $_SESSION['OTP_CUSTOMER_ID'] = $CustomerId;

   SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
   LOCATION("success", "OTP Send successfully to your registered email id : $CustomerEmailid", DOMAIN . "/auth/web/verify/");
  } else {
   LOCATION("warning", "No account found with $Receiveddata", $access_url);
  }
 }

 //sent otp again
} elseif (isset($_POST['TryAgainOtp'])) {
 $CustomerEmailid = $_SESSION['SUBMIITED_EMAIL'];
 $RandomOTP = rand(111111, 999999);
 $_SESSION['SENT_OTP'] = $RandomOTP;
 $CustomerName = FETCH("SELECT * FROM customers where CustomerEmailid='$CustomerEmailid'", 'CustomerName');
 SENDMAILS("OTP for account verification : $RandomOTP", "Dear, $CustomerName", $CustomerEmailid, '<span class="otp-section">' . $RandomOTP . '</span> is your One Time Password (OTP) for account verifications at' . APP_NAME . '. Enter This to Verify your account.<br><br> if this request is not send by you then please reset your account immedietly.');
 LOCATION("info", "OTP Sent Again successfully!", $access_url);

 //change admin or user password and verify account
} elseif (isset($_POST['SearchAccountForPasswordReset'])) {
 $UserEmailId = $_POST['UserEmailId'];
 $UserExits = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId'");
 $CREATED_OTP = rand(111111, 999999);

 if ($UserExits != null) {
  $PasswordResetRequestAuthToken = rand(111111, 999999) . "- Date - " . date("Y-m-d h:i:s a") . " For" . APP_NAME;
  $PasswordChangeTokenization = SECURE($PasswordResetRequestAuthToken, "e");
  $_SESSION['CREATED_OTP'] = $CREATED_OTP;
  $_SESSION['REQUESTED_EMAIL'] = $UserEmailId;
  $UserId = FETCH("SELECT * from users where UserEmailId='$UserEmailId'", "UserId");

  //create Password reset Token with expire limit
  $PasswordReqData = array(
   "UserIdForPasswordChange" => FETCH("SELECT * from users where UserEmailId='$UserEmailId'", "UserEmailId"),
   "PasswordChangeTokenExpireTime" => date('d-m-Y H:i', strtotime("+10 min")),
   "PasswordChangeDeviceDetails" => SECURE(SYSTEM_INFO, "e"),
   "PasswordChangeToken" => $PasswordChangeTokenization,
   "PasswordChangeRequestStatus" => "Active"
  );

  //mail template data
  $Allowedto = SECURE($UserEmailId, "e");
  if (DEVICE_TYPE == "MOBILE" || DEVICE_TYPE == "TABLET") {
   $PasswordResetLink = DOMAIN . "/auth/main/?reset=true&token=$PasswordChangeTokenization&for=$Allowedto";
  } else {
   $PasswordResetLink = DOMAIN . "/auth/admin/?reset=true&token=$PasswordChangeTokenization&for=$Allowedto";
  }
  $UpdatePreviousLinks = UPDATE("UPDATE user_password_change_requests SET PasswordChangeRequestStatus='Expired' where UserIdForPasswordChange='$UserId'");
  $Save = INSERT("user_password_change_requests", $PasswordReqData, false);

  //sent on mails
  $Mail = SENDMAILS("Password Reset Request Received!", "Verify Your Account!", $UserEmailId, "Your Password Reset Request is Received<br><br> You can change your password by clicking on the below link.<br><br> If this request is not sent by you then you may have to change your password immedietly.<br><br> $PasswordResetLink");

  //check mail status
  if ($Mail == true) {
   if (DEVICE_TYPE == "MOBILE" || DEVICE_TYPE == "TABLET") {
    $access_url = DOMAIN . "/auth/main/?verify=true&view=Account Verification";
   } else {
    $access_url = DOMAIN . "/auth/admin/?verify=true&view=Account Verification";
   }
   LOCATION("success", "Password Change Link is sent on <b>$UserEmailId</b> Successfully!", "$access_url");
  } else {
   LOCATION("warning", "Unable to sent password reset link at the moment please try again after some time!", "$access_url");
  }
 } else {
  LOCATION("warning", "No any user is listed with " . $_POST['UserEmailId'] . ". Please check entered email id", "$access_url");
 }

 //check account verification request
} else if (isset($_POST['RequestAccountVerifications'])) {
 $SubmittedOTP = $_POST['SubmittedOTP'];
 if ($SubmittedOTP == $_SESSION['CREATED_OTP']) {
  $_SESSION['ACCOUNT_VERIFICATION_REQUEST'] = true;
  $_SESSION['ACCOUNT_VERIFICATION_REQUEST_EMAIL'] = $_SESSION['REQUESTED_EMAIL'];
  if (DEVICE_TYPE == "MOBILE" || DEVICE_TYPE == "TABLET") {
   $access_url = DOMAIN . "/auth/main/?password-reset=true&view=Recover%20Password";
  } else {
   $access_url = DOMAIN . "/auth/admin/?password-reset=true&view=Recover%20Password";
  }
  LOCATION("success", "Account Verification Completed! Please change your password!", "$access_url");
 } else {
  LOCATION("warning", "Invalid OTP!", "$access_url");
 }

 //request for password change with requested otp
} elseif (isset($_POST['RequestForPasswordChange'])) {
 $Password1 = $_POST['Password1'];
 $Password2 = $_POST['Password2'];
 if ($Password1 != $Password2) {
  LOCATION("warning", "Password Mismatch!", "$access_url");
 } else {
  $UserEmailId = $_SESSION['REQUESTED_EMAIL_ID'];
  $PasswordChangeToken = $_SESSION['PASSWORD_RESET_TOKEN'];
  $UserExits = CHECK("SELECT * FROM users where UserEmailId='$UserEmailId'");
  if ($UserExits != null) {
   $update = UPDATE("UPDATE users SET UserPassword='$Password1' where UserEmailId='$UserEmailId'");
   if ($update == true) {
    SENDMAILS("PASSWORD CHANGED", "Your Password has been changed!", $UserEmailId, "Your Password has been changed successfully. <br> <br> Thank You.");
    GENERATE_APP_LOGS("PASSWORD-CHANGED", "Password changed for User : " . $UserEmailId . ", Pass : " . $Password2, "PASSWORD-RESET");

    //token and user email-id
    $_SESSION['REQUESTED_EMAIL_ID'] = null;
    $_SESSION['PASSWORD_RESET_TOKEN'] = null;

    //expired the used session
    $data = array(
     "PasswordChangeRequestStatus" => "Expired",
    );
    $Update = UPDATE_TABLE("user_password_change_requests", $data, "PasswordChangeToken='$PasswordChangeToken'");

    //redirect to login page
    if (DEVICE_TYPE == "MOBILE" || DEVICE_TYPE == "TABLET") {
     $access_url = DOMAIN . "/auth/main/";
    } else {
     $access_url = DOMAIN . "/auth/admin/";
    }
    LOCATION("success", "Password Changed Successfully!", "$access_url");

    //check in case of incorrect
   } else {
    LOCATION("warning", "Unable to change password!", "$access_url");
   }
  } else {
   LOCATION("warning", "User Not Found at the time of Password Change Request, Please try again...", "$access_url");
  }
 }
}
