<?php

/**
 * @load system files
 * 
 */
//system url handler
require __DIR__ . "/SysUrlHandler.php";

//DB File Loader
require __DIR__ . "/SysDatabase/SystemDBConnector.php";

//system Module Manager
require __DIR__ . "/SystemFileProcessor.php";

//system configuration Handler
require __DIR__ . "/SystemConfigurations.php";

//system assets Handlers
require __DIR__ . "/../assets/AssetsHandler.php";
