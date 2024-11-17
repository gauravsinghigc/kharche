<?php
if (DEVICE_TYPE == "COMPUTER") {
 include __DIR__ . "/sections/DesktopViewHeader.php";
} else {
 include __DIR__ . "/sections/MobileViewHeader.php";
}
