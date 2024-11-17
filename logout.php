<?php
session_start();
session_destroy();
setcookie("APP_LOGIN_USER_ID", null, time() - 315360000);
header("location: index.php");
