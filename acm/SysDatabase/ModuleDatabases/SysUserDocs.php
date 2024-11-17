<?php
//user documents
$USER_DOCUMENTS = "CREATE TABLE `user_documents` (
  `UserDocsId` int(100) NOT NULL,
  `UserMainId` varchar(100) NOT NULL,
  `UserDocumentNo` varchar(100) NOT NULL,
  `UserDocumentName` varchar(100) NOT NULL,
  `UserDocumentFile` varchar(250) NOT NULL
)";
$PRIMARY_KEY = "ALTER TABLE `user_documents` ADD PRIMARY KEY (`UserDocsId`)";
$PRIMARY_DATA = "ALTER TABLE `user_documents` MODIFY `UserDocsId` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
mysqli_query(DBConnection, $USER_DOCUMENTS);
mysqli_query(DBConnection, $PRIMARY_KEY);
mysqli_query(DBConnection, $PRIMARY_DATA);
