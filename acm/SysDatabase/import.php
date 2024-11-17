<body style="font-size:0.8rem !important;font-family:system-ui;word-spacing:0.1rem;">
 <?php
 //require DB Connector
 require __DIR__ . "/SystemDBConnector.php";

 $DB_TABLESS = array(
  "SysConfigSql.php",
  "SysPGSql.php",
  "SysUserSql.php",
  "SysLogs.php",
  "SysUserAddress.php",
  "SysUserAttributes.php",
  "SysUserDocs.php",
  "SysUserPassReq.php",
  "SysUserPermission.php",
 );
 $Count = 0;
 foreach ($DB_TABLESS as $Tables) {
  $Count++;
  require __DIR__ . "/ModuleDatabases/$Tables";
  echo "<code>$Count { <b>SQL Tables : </b>" . $Tables . " => Imported in Database</code> }<br>";
 }
 ?>
</body>