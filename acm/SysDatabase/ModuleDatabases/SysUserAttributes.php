<?php
//user attributes
$USER_ATTRIBUTES = "CREATE TABLE `user_attributes` (
`UserAttributeId` int(100) NOT NULL,
`MainUserId` int(100) NOT NULL,
`UserAttributeType` varchar(100) NOT NULL,
`UserAttributeValue` varchar(10000) NOT NULL,
`UserAttributeCreatedAt` varchar(30) NOT NULL,
`UserAttributeUpdatedAt` varchar(30) NOT NULL
)";
$PRIMARY_KEY = "ALTER TABLE `user_attributes` ADD PRIMARY KEY (`UserAttributeId`)";
$PRIMARY_DATA = "ALTER TABLE `user_attributes` MODIFY `UserAttributeId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
mysqli_query(DBConnection, $USER_ATTRIBUTES);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);
