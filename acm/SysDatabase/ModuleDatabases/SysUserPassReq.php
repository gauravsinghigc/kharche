<?php
//user password reset request
$USER_PASSWORD_REQUEST = "CREATE TABLE `user_password_change_requests` (
`PasswordChangeReqId` int(100) NOT NULL,
`UserIdForPasswordChange` varchar(1000) NOT NULL,
`PasswordChangeToken` varchar(1000) NOT NULL,
`PasswordChangeTokenExpireTime` varchar(1000) NOT NULL,
`PasswordChangeDeviceDetails` varchar(10000) NOT NULL,
`PasswordChangeRequestStatus` varchar(1000) NOT NULL
)";
$PRIMARY_KEY = "ALTER TABLE `user_password_change_requests` ADD PRIMARY KEY (`PasswordChangeReqId`)";
$PRIMARY_DATA = "ALTER TABLE `user_password_change_requests` MODIFY `PasswordChangeReqId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
mysqli_query(DBConnection, $USER_PASSWORD_REQUEST);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);
