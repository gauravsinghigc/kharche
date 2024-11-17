<?php

/**
 * @SystemUserNeedAccess
 * $access_type = REQUIRED or PROVIDED
 */

//for login checker
function SystemUserAccess($access_type)
{
 if ($access_type == "REQUIRED") {
  if (!isset($_SESSION['SYSTEM_LOGIN_USER_ID'])) {
   header("location:" . DOMAIN . "/auth/admin");
  }
 } else if ($access_type == "PROVIDED") {
  if (isset($_SESSION['SYSTEM_LOGIN_USER_ID'])) {
   header("location:" . DOMAIN . "/sys/");
  }
 } else {
  echo "<b>Error:</b> SystemUserAccess() value can't be null or empty, it may have REQUIRED or PROVIDED";
  die();
 }
}


//app user login checker
function ApplicationUserAccess($access_type)
{
 if ($access_type == "REQUIRED") {
  if (!isset($_SESSION['APP_LOGIN_USER_ID'])) {
   header("location:" . DOMAIN . "/auth/main");
  }
 } else if ($access_type == "PROVIDED") {
  if (isset($_SESSION['APP_LOGIN_USER_ID'])) {
   header("location:" . DOMAIN . "/in/");
  }
 } else {
  echo "<b>Error:</b> ApplicationUserAccess() value can't be null or empty, it may have REQUIRED or PROVIDED";
  die();
 }
}
