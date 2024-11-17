<?php
session_start();
session_destroy();

//setcookie("APP_LOGIN_USER_ID", '', time() - 60 * 60 * 365);

header("location: ../index.php");
