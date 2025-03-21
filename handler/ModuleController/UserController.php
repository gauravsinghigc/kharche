<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";


//update profile image 
if (isset($_POST['updateprofileimage'])) {
 $UserId  = $_POST['updateprofileimage'];
 $UserProfileImage = UPLOAD_FILES("../../storage/users/$UserId/img", "null", "Profile" . "_UID_" . $UserId, "Profile", "UserProfileImage");
 $Update = UPDATE("UPDATE users SET UserProfileImage='$UserProfileImage' where UserId='$UserId'");
 RESPONSE($Update, "Profile Image Updated!", "Unable to update profile image!");

 //remove employee
} else if (isset($_GET['remove_team_member'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $remove_team_member = SECURE($_GET['remove_team_member'], "d");

 if ($remove_team_member == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("users", "UserId='$control_id'");
  $delete = DELETE_FROM("user_addresses", "UserAddressUserId='$control_id'");
  $delete = DELETE_FROM("user_bank_details", "UserMainId='$control_id'");
  $delete = DELETE_FROM("user_documents", "UserMainId='$control_id'");
  $delete = DELETE_FROM("user_employment_details", "UserMainUserId='$control_id'");
 } else {
  $delete = false;
 }
 RESPONSE($delete, "Team member is removed successfully!", "Unable to remove team member!");

 //update primary data
} elseif (isset($_POST['UpdateProfile'])) {
 $UserId = SECURE($_POST['UserId'], "d");

 $primarydata = array(
  "UserFullName" => $_POST['UserFullName'],
  "UserPhoneNumber" => $_POST['UserPhoneNumber'],
  "UserEmailId" => $_POST['UserEmailId'],
  "UserUpdatedAt" => CURRENT_DATE_TIME,
  "UserPriceType" => $_POST['UserPriceType'],
 );

 $Update = UPDATE_TABLE("users", $primarydata, "UserId='$UserId'");
 RESPONSE($Update, $_POST['UserFullName'] . " profile is updated successfully!", "Unable to update profile at the moment!");

 //update address
} elseif (isset($_POST['UpdateAddress'])) {
 $UserId = SECURE($_POST['UserId'], "d");

 $Address = array(
  "UserAddressUserId" => $UserId,
  "UserStreetAddress" => POST("UserStreetAddress"),
  "UserLocality" => $_POST['UserLocality'],
  "UserCity" => $_POST['UserCity'],
  "UserState" => $_POST['UserState'],
  "UserCountry" => $_POST['UserCountry'],
  "UserPincode" => $_POST['UserPincode'],
  "UserAddressType" => $_POST['UserAddressType'],
  "UserAddressContactPerson" => $_POST['UserAddressContactPerson'],
 );

 $CheckAddress = CHECK("SELECT * FROM user_addresses where UserAddressUserId='$UserId'");
 if ($CheckAddress == null) {
  $Update = INSERT("user_addresses", $Address);
 } else {
  $Update = UPDATE_TABLE("user_addresses", $Address, "UserAddressUserId='$UserId'");
 }
 RESPONSE($Update, "Address details are updated successfully!", "Unable to update address details at the moment!");

 //update employment details
} elseif (isset($_POST['UpdateEmployement'])) {
 $UserId = SECURE($_POST['UserId'], "d");

 $EmpDetails = array(
  "UserMainUserId" => $UserId,
  "UserEmpBackGround" => $_POST['UserEmpBackGround'],
  "UserEmpTotalWorkExperience" => $_POST['UserEmpTotalWorkExperience'],
  "UserEmpPreviousOrg" => $_POST['UserEmpPreviousOrg'],
  "UserEmpBloodGroup" => $_POST['UserEmpBloodGroup'],
  "UserEmpReraId" => $_POST['UserEmpReraId'],
  "UserEmpReportingMember" => $_POST['UserEmpReportingMember'],
  "UserEmpJoinedId" => $_POST['UserEmpJoinedId'],
  "UserEmpCRMStatus" => $_POST['UserEmpCRMStatus'],
  "UserEmpVisitingCard" => $_POST['UserEmpVisitingCard'],
  "UserEmpWorkEmailId" => $_POST['UserEmpWorkEmailId'],
  "UserEmpGroupName" => $_POST['UserEmpGroupName'],
  "UserEmpType" => $_POST['UserEmpType'],
  "UserEmpLocations" => $_POST['UserEmpLocations'],
  "UserEmpRoleStatus" => $_POST['UserEmpRoleStatus'],
 );

 $CheckEMp = CHECK("SELECT * FROM user_employment_details where UserMainUserId='$UserId'");
 if ($CheckEMp == null) {
  $Update = INSERT("user_employment_details", $EmpDetails);
 } else {
  $Update = UPDATE_TABLE("user_employment_details", $EmpDetails, "UserMainUserId='$UserId'");
 }
 RESPONSE($Update, "Employement details are updated successfully!", "Unable to update Employement details at the moment!");

 //update bank details
} else if (isset($_POST['UpdateBankDetails'])) {
 $UserId = SECURE($_POST['UserId'], "d");

 $BANKDETAILS = array(
  "UserMainId" => $UserId,
  "UserBankName" => $_POST['UserBankName'],
  "UserBankAccountNo" => $_POST['UserBankAccountNo'],
  "UserBankIFSC" => $_POST['UserBankIFSC'],
  "UserBankAccoundHolderName" => $_POST['UserBankAccoundHolderName'],
 );

 $CheckEMp = CHECK("SELECT * FROM user_bank_details where UserMainId='$UserId'");
 if ($CheckEMp == null) {
  $Update = INSERT("user_bank_details", $BANKDETAILS);
 } else {
  $Update = UPDATE_TABLE("user_bank_details", $BANKDETAILS, "UserMainId='$UserId'");
 }
 RESPONSE($Update, "Bank Account details are updated successfully!", "Unable to update Bank Account details at the moment!");

 //upload documents
} elseif (isset($_POST['UploadDocuments'])) {
 $UserId = SECURE($_POST['UserId'], "d");

 $documents = array(
  "UserMainId" => $UserId,
  "UserDocumentNo" => $_POST['UserDocumentNo'],
  "UserDocumentName" => $_POST['UserDocumentName'],
  "UserDocumentFile" => UPLOAD_FILES("../../storage/teams/documents/$UserId", "null", "PanCard", $_POST['PancardNo'], "UserDocumentFile"),
 );

 $Update = INSERT("user_documents", $documents);
 RESPONSE($Update, "Documents are uploaded successfully!", "Unable to upload documents at the moment!");

 //remove documents
} elseif (isset($_GET['remove_user_documents'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $remove_user_documents = SECURE($_GET['remove_user_documents'], "d");

 if ($remove_user_documents == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $delete = DELETE_FROM("user_documents", "UserDocsId='$control_id'");
 } else {
  $delete = false;
 }

 RESPONSE($delete, "Document is removed successfully!", "Unable to remove documents at the moment!");

 //update password
} elseif (isset($_POST['UpdatePassword'])) {
 $UserId = $_SESSION['REQ_UserId'];

 $data = array(
  "UserPassword" => $_POST['UserPassword'],
 );

 $Update = UPDATE_TABLE("users", $data, "UserId='$UserId'");
 RESPONSE($Update, "Password is updated successfully!", "Unable to update password at the moment!");

 //create account
} elseif (isset($_POST['CreateAccount'])) {

 $data = array(
  "UserFullName" => $_POST['UserFullName'],
  "UserPhoneNumber" => $_POST['UserPhoneNumber'],
  "UserEmailId" => $_POST['UserEmailId'],
  "UserPassword" => "Null",
  "UserRole" => "APP_USER",
  "UserCreatedAt" => CURRENT_DATE_TIME,
  "UserCreatedBy" => "1",
  "UserGender" => $_POST['UserGender'],
  "UserPriceType" => $_POST['UserPriceType'],
  "UserPassword" => $_POST['UserPassword'],
  "UserLoginStatus" => "true"
 );

 $UserPhoneNumber = $_POST['UserPhoneNumber'];
 $UserEmailId = $_POST['UserEmailId'];

 $CheckUserExits = CHECK("SELECT * FROM users where UserPhoneNumber='$UserPhoneNumber'");
 if ($CheckUserExits == true) {
  RESPONSE(false, "", "Phone number already exits");
 } else {
  $CheckMail = CHECK("SELECT * FROM users WHERE UserEmailId='$UserEmailId'");
  if ($CheckMail == true) {
   RESPONSE(false, "", "Email Id already exists");
  } else {
   $SaveUsers = INSERT("users", $data);
  }
 }

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
  $PasswordResetLink = DOMAIN . "/auth/main/?reset=true&view=Change Password&token=$PasswordChangeTokenization&for=$Allowedto";
  $UpdatePreviousLinks = UPDATE("UPDATE user_password_change_requests SET PasswordChangeRequestStatus='Expired' where UserIdForPasswordChange='$UserId'");
  $Save = INSERT("user_password_change_requests", $PasswordReqData, false);

  //sent on mails
  $Mail = SENDMAILS("Password Reset Request Received!", "Verify Your Account!", $UserEmailId, "Your Password Reset Request is Received<br><br> You can change your password by clicking on the below link.<br><br> If this request is not sent by you then you may have to change your password immedietly.<br><br> $PasswordResetLink");

  //check mail status
  $access_url = DOMAIN . "/auth/main/index.php";
  LOCATION("success", "Account Created Successfully for <b>$UserEmailId</b>. Login Now", "$access_url");
 } else {
  LOCATION("warning", "No any user is listed with " . $_POST['UserEmailId'] . ". Please check entered email id", "$access_url");
 }
}
