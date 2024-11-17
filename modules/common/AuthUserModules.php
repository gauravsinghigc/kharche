<?php

/**
 * @SystemUserModule
 */

function AuthUser($require)
{
 $UserId = $_SESSION['SYSTEM_LOGIN_USER_ID'];

 if (empty($UserId)) {
  return null;
 } else {
  $CheckUsers = CHECK("SELECT * FROM users where UserId='$UserId'");
  if ($CheckUsers == null) {
   return null;
  } else {
   $GetData = FETCH("SELECT * FROM users where UserId='$UserId'", "$require");
   if ($require == "UserProfileImage") {
    if ($GetData == "user.png") {
     return STORAGE_URL_D . "/default.png";
    } else {
     return STORAGE_URL_U . "/$UserId/img/$GetData";
    }
   } else {
    return $GetData;
   }
  }
 }
}

function AuthAppUser($require)
{
 $UserId = $_SESSION['APP_LOGIN_USER_ID'];
 if (empty($UserId)) {
  return null;
 } else {
  $CheckUsers = CHECK("SELECT * FROM users where UserId='$UserId'");
  if ($CheckUsers == null) {
   return null;
  } else {
   $GetData = FETCH("SELECT * FROM users where UserId='$UserId'", "$require");
   if ($require == "UserProfileImage") {
    if ($GetData == "user.png") {
     return STORAGE_URL_D . "/default.png";
    } else {
     return STORAGE_URL_U . "/$UserId/img/$GetData";
    }
   } else {
    return $GetData;
   }
  }
 }
}
