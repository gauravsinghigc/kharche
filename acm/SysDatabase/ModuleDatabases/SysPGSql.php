<?php
//table name
$TABLE_NAME = "CREATE TABLE `config_pgs` (
  `ConfigPgId` int(100) NOT NULL,
  `ConfigPgProvider` varchar(100) NOT NULL,
  `ConfigPgMode` varchar(100) NOT NULL,
  `ConfigPgMerchantId` varchar(500) NOT NULL,
  `ConfigPgMerchantKey` varchar(500) NOT NULL
)";

//config table 
$PRIMARY_KEY = "ALTER TABLE `config_pgs` ADD PRIMARY KEY (`ConfigPgId`)";
$PRIMARY_DATA = "ALTER TABLE `config_pgs` MODIFY `ConfigPgId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3";
mysqli_query(DBConnection, $TABLE_NAME);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);

//table fields
$InsertData = "INSERT INTO `config_pgs` (`ConfigPgId`, `ConfigPgProvider`, `ConfigPgMode`, `ConfigPgMerchantId`, `ConfigPgMerchantKey`) VALUES
(1, 'RAZORAPAY', 'jhvjhdsbvj', 'jbcjhbdbfm b', 'qkjbdjkfbvjdbvkdbkjvbdkjbjkbdjkfd vjdbvgjhdfhbvdf')";

mysqli_query(DBConnection, $InsertData);
