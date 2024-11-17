<?php

/**
 * URL Handler
 * 
 */

//Display Errors
ini_set("display_errors", 1);

//session_start()
session_start();
ob_start();

//App Configurations
//Change configuration according to your need and project requirements
//check SSL is installed or not
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
  $link = "https";
} else {
  $link = "http";
}

// Here append the common URL characters.
$link .= "://";

//dir & domain setup
define("HOST", $HOST = $_SERVER['SERVER_NAME']);

//list of local hosts or servers
define("LOCAL_HOST", array(
  "127.0.0.1",
  "::1",
  "localhost",
  "192.168.1.9",
  "192.168.43.14",
  "192.168.1.10",
  "192.168.1.11",
  "192.168.1.3",
  "192.168.141.206",
  "192.168.92.206",
  "192.168.1.7",
  "192.168.203.206",
  "192.168.1.5",
  "192.168.45.206"
));

//filter domain from local or live server
if (in_array("" . HOST . "", LOCAL_HOST)) {
  define("DOMAIN", $link . HOST . "/kharche");
} else {
  define("DOMAIN", $link . HOST);
}

//app constant
define("APP_URL", DOMAIN . "/app");
define("ADMIN_URL", DOMAIN . "/sys");
define("WEB_URL", DOMAIN . "/in");
define("STORAGE_URL", DOMAIN . "/storage");
define("STORAGE_URL_D", STORAGE_URL . "/default");
define("STORAGE_URL_U", STORAGE_URL . "/users");
define("CONTROLLER", DOMAIN . "/handler");
define("ASSETS_URL", DOMAIN . "/assets");
define("SYS_ICON_STORAGE_URL", STORAGE_URL . "/icons");
