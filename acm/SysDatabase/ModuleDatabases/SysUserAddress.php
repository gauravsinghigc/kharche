<?php
//user address
$USER_ADDRESS = "CREATE TABLE `user_addresses` (
`UserAddressId` int(100) NOT NULL,
`MainUserId` int(100) NOT NULL,
`UserStreetAddress` varchar(200) DEFAULT NULL,
`UserAddressBlock` varchar(30) NOT NULL,
`UserAreaLocality` varchar(30) NOT NULL,
`UserNearByLocation` varchar(50) NOT NULL,
`UserCity` varchar(25) NOT NULL,
`UserState` varchar(20) NOT NULL,
`UserPincode` varchar(10) NOT NULL,
`UserCountry` varchar(30) NOT NULL,
`UserContactPersonName` varchar(35) NOT NULL,
`UserContactPersonPhone` varchar(15) NOT NULL,
`UserAddressCreatedAt` varchar(30) NOT NULL,
`UserAddressUpdatedAt` varchar(30) NOT NULL
)";
$PRIMARY_KEY = "ALTER TABLE `user_addresses` ADD PRIMARY KEY (`UserAddressId`)";
$PRIMARY_DATA = "ALTER TABLE `user_addresses` MODIFY `UserAddressId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
mysqli_query(DBConnection, $USER_ADDRESS);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);
