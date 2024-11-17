<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";

//admin login request
if (isset($_POST['LoginRequest'])) {
    $UserPassword = $_POST['UserPassword'];
    $UserPhoneNumber = $_POST['UserPhoneNumber'];
    $CheckUsername = CHECK("SELECT * FROM users where UserPhoneNumber='$UserPhoneNumber' and UserPassword='$UserPassword'");

    if ($CheckUsername == true) {
        //get user details
        $Sql = "SELECT * FROM users where UserPhoneNumber='$UserPhoneNumber' and UserLoginStatus='true'";
        $UserId = FETCH($Sql, "UserId");
        $UserFullName = FETCH($Sql, "UserFullName");
        $UserRole = FETCH($Sql, "UserRole");

        GENERATE_APP_LOGS("CP_SUCCESS", "New Login Received @ User : " . $UserPhoneNumber . ", Pass : " . SECURE($UserPassword, "d",), "LOGIN");

        //open application 
        $_SESSION['APP_LOGIN_USER_ID'] = $UserId;
        LOCATION("success", "Welcome $UserFullName, Login Successful!", DOMAIN . "/app");
    } else {
        GENERATE_APP_LOGS("CP_BLOCK", "New Login Received @ User : " . $UserPhoneNumber . ", Pass : " . SECURE($UserPassword, "d"), "LOGIN");
        LOCATION("warning", "Please check your Email-Id and Password. They are incorrect, Please try again with valid Email-ID and Password!", "$access_url");
    }

    //search account for sending password reset link
} elseif (isset($_POST['SearchAccountForPasswordReset'])) {
    $UserPhoneNumber = $_POST['UserPhoneNumber'];
    $UserExits = CHECK("SELECT * FROM users where UserPhoneNumber='$UserPhoneNumber'");
    $CREATED_OTP = rand(111111, 999999);

    if ($UserExits != null) {
        $UserEmailId = FETCH("SELECT * FROM users where UserPhoneNumber='$UserPhoneNumber'", "UserEmailId");
        $PasswordResetRequestAuthToken = rand(111111, 999999) . "- Date - " . date("Y-m-d h:i:s a") . " For" . APP_NAME;
        $PasswordChangeTokenization = SECURE($PasswordResetRequestAuthToken, "e");
        $_SESSION['CREATED_OTP'] = $CREATED_OTP;
        $_SESSION['REQUESTED_EMAIL'] = $UserPhoneNumber;
        $UserId = FETCH("SELECT * from users where UserPhoneNumber='$UserPhoneNumber'", "UserId");

        //create Password reset Token with expire limit
        $PasswordReqData = array(
            "UserIdForPasswordChange" => FETCH("SELECT * from users where UserPhoneNumber='$UserPhoneNumber'", "UserEmailId"),
            "PasswordChangeTokenExpireTime" => date('d-m-Y H:i', strtotime("+10 min")),
            "PasswordChangeDeviceDetails" => SECURE(SYSTEM_INFO, "e"),
            "PasswordChangeToken" => $PasswordChangeTokenization,
            "PasswordChangeRequestStatus" => "Active"
        );

        //mail template data
        $Allowedto = SECURE($UserEmailId, "e");
        $PasswordResetLink = DOMAIN . "/auth/reset/?reset=true&token=$PasswordChangeTokenization&for=$Allowedto";
        $UpdatePreviousLinks = UPDATE("UPDATE user_password_change_requests SET PasswordChangeRequestStatus='Expired' where UserIdForPasswordChange='$UserId'");
        $Save = INSERT("user_password_change_requests", $PasswordReqData, false);

        //sent on mails
        $Mail = SENDMAILS("Password Reset Request Received!", "Verify Your Account!", $UserEmailId, "Your Password Reset Request is Received<br><br> You can change your password by clicking on the below link.<br><br> If this request is not sent by you then you may have to change your password immedietly.<br><br> $PasswordResetLink");

        //check mail status
        if ($Mail == true) {
            $access_url = DOMAIN . "/auth/sent/";
            LOCATION("success", "Password Change Link is sent on <b>$UserEmailId</b> Successfully!", "$access_url");
        } else {
            LOCATION("warning", "Unable to sent password reset link at the moment please try again after some time!", "$access_url");
        }
    } else {
        LOCATION("warning", "No any user is listed with " . $_POST['UserPhoneNumber'] . ". Please check entered email id", "$access_url");
    }

    //check account verification request
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
                $access_url = DOMAIN . "/auth/login/";
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
