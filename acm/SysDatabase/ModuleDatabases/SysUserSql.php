<?php
//table name
$TABLE_NAME = "CREATE TABLE `users` (
  `UserId` bigint(100) NOT NULL,
  `UserFullName` varchar(50) NOT NULL,
  `UserPhoneNumber` varchar(15) NOT NULL,
  `UserEmailId` varchar(100) NOT NULL,
  `UserPassword` varchar(20) NOT NULL,
  `UserRole` varchar(50) NOT NULL,
  `UserCreatedAt` varchar(50) NOT NULL,
  `UserUpdatedAt` varchar(50) NOT NULL,
  `UserCreatedBy` varchar(100) NOT NULL,
  `UserUpdatedBy` varchar(100) NOT NULL,
  `UserLoginStatus` varchar(10) NOT NULL DEFAULT 'false',
  `UserPhoneStatus` varchar(10) NOT NULL DEFAULT 'unverified',
  `UserEmailStatus` varchar(10) NOT NULL DEFAULT 'unverified',
  `UserDateOfBirth` varchar(50) NOT NULL,
  `UserGender` varchar(10) NOT NULL,
  `UserProfileImage` varchar(500) NOT NULL DEFAULT 'user.png'
)";

//config table 
$PRIMARY_KEY = "ALTER TABLE `users` ADD PRIMARY KEY (`UserId`)";
$PRIMARY_DATA = "ALTER TABLE `users` MODIFY `UserId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2";
mysqli_query(DBConnection, $TABLE_NAME);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);

//table fields
$InsertData = "INSERT INTO `users` (`UserId`, `UserFullName`, `UserPhoneNumber`, `UserEmailId`, `UserPassword`, `UserRole`, `UserCreatedAt`, `UserUpdatedAt`, `UserCreatedBy`, `UserUpdatedBy`, `UserLoginStatus`, `UserPhoneStatus`, `UserEmailStatus`, `UserDateOfBirth`, `UserGender`, `UserProfileImage`) VALUES
(1, 'Gaurav Singh', '8447572565', 'gauravsinghigc@gmail.com', 'Gsi@9810', 'SUPER_ADMIN', '06-11-2022', '06-11-2022', 'self', 'self', 'true', 'verified', 'verified', '22-01-2022', 'male', 'user.png')";

mysqli_query(DBConnection, $InsertData);
