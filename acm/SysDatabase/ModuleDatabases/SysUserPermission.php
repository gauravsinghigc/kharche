<?php
//user permissions
$USER_PERMISSION = "CREATE TABLE `user_permissions` (
  `UserPermissionId` int(100) NOT NULL,
  `UserMainUserId` int(100) NOT NULL,
  `UserPermissionValue` varchar(50) DEFAULT NULL
)";
$PRIMARY_KEY = "ALTER TABLE `user_permissions` ADD PRIMARY KEY (`UserPermissionId`)";
$PRIMARY_DATA = "ALTER TABLE `user_permissions` MODIFY `UserPermissionId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
mysqli_query(DBConnection, $USER_PERMISSION);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);
