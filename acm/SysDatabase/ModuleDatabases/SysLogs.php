<?php
//system logs
$SYSTEM_LOGS = "CREATE TABLE `systemlogs` (
  `systemlogsid` bigint(100) NOT NULL,
  `logTitle` varchar(100) NOT NULL,
  `logdesc` varchar(1000) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `systeminfo` varchar(10000) NOT NULL,
  `logtype` varchar(100) NOT NULL,
  `logenv` varchar(100) NOT NULL
)";
$PRIMARY_KEY = "ALTER TABLE `systemlogs` ADD PRIMARY KEY (`systemlogsid`)";
$PRIMARY_DATA = "ALTER TABLE `systemlogs` MODIFY `systemlogsid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
mysqli_query(DBConnection, $SYSTEM_LOGS);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);
