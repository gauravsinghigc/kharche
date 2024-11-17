<?php

if (!isset($_SESSION['APP_LOGIN_USER_ID'])) {
    header("location:" . DOMAIN . "/auth/");
} else {
    define("LOGIN_USER_ID", $_SESSION['APP_LOGIN_USER_ID']);
}
