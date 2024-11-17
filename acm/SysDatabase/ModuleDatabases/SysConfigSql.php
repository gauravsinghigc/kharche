<?php
//table name
$TABLE_NAME = "CREATE TABLE `configurations` (
  `configurationsid` int(100) NOT NULL,
  `configurationname` varchar(50) NOT NULL,
  `configurationvalue` varchar(9999) NOT NULL,
  `configurationtype` varchar(30) NOT NULL DEFAULT 'text',
  `configurationsupportivetext` varchar(1000) NOT NULL DEFAULT 'null'
)";

//config table 
$PRIMARY_KEY = "ALTER TABLE `configurations` ADD PRIMARY KEY (`configurationsid`)";
$PRIMARY_DATA = "ALTER TABLE `configurations` MODIFY `configurationsid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46";
mysqli_query(DBConnection, $TABLE_NAME);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);

//table fields
$InsertData = "INSERT INTO `configurations` (`configurationsid`, `configurationname`, `configurationvalue`, `configurationtype`, `configurationsupportivetext`) VALUES
(1, 'APP_NAME', 'APP Name', 'TEXT', 'null'),
(2, 'TAGLINE', 'App Tagline', 'text', 'null'),
(3, 'OWNER_NAME', 'Gaurav Singh', 'text', 'null'),
(4, 'PRIMARY_PHONE', '+91 9311382012', 'phone', 'null'),
(5, 'PRIMARY_EMAIL', 'gauravsinghigc@gmail.com', 'email', 'null'),
(6, 'SHORT_DESCRIPTION', 'bVVObWhBaDNwYnZoTzdBamdKM1Q0Z2ZjNldvTmpWTWtqRFQyazNZUTE2cz0=', 'text', 'null'),
(7, 'PRIMARY_ADDRESS', 'N2xGcEkxZURhdU5tS25ZRWkxVFZieVdGU1RSRFpyRllnemREbW9sY3JGZ0VVREhnVWU1Tm9VZS93ZHZMdE9qT1ozWWlNdjdQcHp3NmFsdkk5ZG1QN0JOellSZ0pmZFdQSE9Oa0RiVTJxdUU9', 'address', 'null'),
(8, 'PRIMARY_MAP_LOCATION_LINK', 'M3N6cEE1V0syMjBKWE9JamJ0d2dERVk0aGNLSGw4cW5SUjYyKzY1NWNvQzVtcmZuc1JkVS81dTRsbFZCaGFuU0ZTVDZ2N1hMNDVuVzNoV3ROaEErZGJRa2hzV2FJbDVjREpGZFo2OUZ0R0pKbnlkNUtuZzFVLzRqdmwycWhnYlZWd0ZGUThnMHA5VE9TdnYwYnpSblZSenlDbUJjNVdFc0xaZEd2Mng5NVBqVnlTYThjZitzaE5ZL04vdU4wdTZnQk1rS3FORnJhYVo5QVBTbzJHczhIaEJTcVgzMStoOHpDM1prRURkV0Z0UFJPMkcyalQ4Mit1Uk5tRWJYUzYrK091R1BkSVR1N3R4ZVpGUTJTSStoM0xCN2xJeko0NXVNMit4Ni9sdyt0M0t2TU45RG5GSXh4U0tmbjRqdzkxcUczNHFlNkhZZHV1SFZTZG9Yc2cwNEpSb0pnbFA5bmlkRk91aHJ2L2NxT0dWUGpTU1A4dEI1MWVOTDVnc05pZlhSYVlQbFdGbVZiQnlQOWk3UE54SFptYjlmUkQ2eEt4SFJhY1gwY1FKd0lXWT0=', 'map', 'null'),
(9, 'SENDER_MAIL_ID', 'gauravsinghigc@gmail.com', 'email', 'null'),
(10, 'RECEIVER_MAIL', 'gauravsinghigc@gmail.com', 'email', 'null'),
(11, 'REPLY_TO', 'not available', 'email', 'null'),
(12, 'SUPPORT_MAIL', 'gauravsinghigc@gmail.com', 'email', 'null'),
(13, 'ENQUIRY_MAIL', 'gauravsinghigc@gmail.com', 'email', 'null'),
(14, 'ADMIN_MAIL', 'gauravsinghigc@gmail.com', 'text', 'null'),
(15, 'SMS_API_KEY', 'null', 'text', 'null'),
(16, 'DOWNLOAD_ANDROID_APP_LINK', 'not available', 'link', 'null'),
(17, 'DOWNLOAD_IOS_APP_LINK', 'DOMAIN', 'link', 'null'),
(18, 'DOWNLOAD_BROCHER_LINK', 'DOMAIN', 'link', 'null'),
(19, 'CONTROL_WORK_ENV', 'DEV', 'boolean', 'dev, prod'),
(20, 'CONTROL_SMS', 'false', 'boolean', 'true, false'),
(21, 'CONTROL_MAILS', 'true', 'boolean', 'true, false'),
(22, 'CONTROL_NOTIFICATION', 'true', 'boolean', 'true, false'),
(23, 'CONTROL_MSG_DISPLAY_TIME', '4500', 'number', '1000, 10000'),
(24, 'CONTROL_APP_LOGS', 'false', 'boolean', 'true, false'),
(25, 'APP_LOGO', 'logo.png', 'img', 'null'),
(26, 'SMS_OTP_TEMP_ID', 'null', 'text', 'null'),
(27, 'PASS_RESET_OTP_TEMP', 'null', 'text', 'null'),
(28, 'SMS_SENDER_ID', 'null', 'text', 'null'),
(29, 'PG_PROVIDER', 'RAZORAPAY', 'text', 'null'),
(30, 'PG_MODE', 'jhvjhdsbvj', 'text', 'null'),
(31, 'MERCHENT_ID', 'jbcjhbdbfm b', 'text', 'null'),
(32, 'MERCHANT_KEY', 'qkjbdjkfbvjdbvkdbkjvbdkjbjkbdjkfd vjdbvgjhdfhbvdf', 'text', 'null'),
(33, 'ONLINE_PAYMENT_OPTION', 'true', 'boolean', 'true, false'),
(34, 'CONTROL_NOTIFICATION_SOUND', 'true', 'boolean', 'true, false'),
(35, 'FINANCIAL_YEAR', 'September - August', 'text', 'null'),
(36, 'GST_NO', '09AALCR4165K1ZT', 'text', 'null'),
(37, 'COMPANY_TYPE', 'PUBLISHING', 'text', 'null'),
(38, 'LOGIN_BG_IMAGE', 'ROOF_&_ASSETS_INFRA_Logo_26_Sep_2022_10_09_48_61750536552_.gif', 'text', 'null'),
(39, 'PRIMARY_AREA', 'M3RKYjIyemJJcnFXZ2xLdzZINzdMNVNqRVJFbkY2ZnpTQ1BmNFdQcUgrMD0=', 'text', 'null'),
(40, 'PRIMARY_CITY', 'Q1o2a0w2NEpQOEFLTHA3ZHdNYjh4UT09', 'text', 'null'),
(41, 'PRIMARY_STATE', 'Rm9nUDlDRTVkV20zWm8wMmEvMEpPZz09', 'text', 'null'),
(42, 'PRIMARY_COUNTRY', 'MmtSc3hhcXA1OU1mNjFaYUJ6VVhIZz09', 'text', 'null'),
(43, 'PRIMARY_PINCODE', 'RjV6emhnOUxVeC9ic29tQ25BV211QT09', 'text', 'null'),
(44, 'TAX_NO', 'DELA61323D1', 'text', 'null'),
(45, 'WEBSITE', 'false', 'boolean', 'null'),
(46, 'APP', 'false', 'booleam', 'null'),
(47, 'COMPANY_NAME', 'GSI SYSTEM', 'text', 'null')";

mysqli_query(DBConnection, $InsertData);
