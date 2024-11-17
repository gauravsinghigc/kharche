<?php

//computer view access manager
if (WEBSITE != "true") {
 header("location: " . DOMAIN . "/soon/");
}

if (APP != "true") {
 header("location: " . DOMAIN . "/soon/");
}

//computer view manager
if (DEVICE_TYPE == "COMPUTER" || DEVICE_TYPE == "TABLET" || DEVICE_TYPE == "BOT" || DEVICE_TYPE == "MOBILE") {
 header("location: " . DOMAIN . "/in");
}
