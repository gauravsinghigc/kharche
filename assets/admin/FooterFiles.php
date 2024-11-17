<?php

/**
 * @AdminFooterFiles
 */

function AdminFooterFiles()
{
 //external javascripts files
 $ExternalJsLinks = array();

 //captured
 foreach ($ExternalJsLinks as $JsLinks) {
  echo "
<script src='" . $JsLinks . "' type='text/javascript'></script> ";
 }
 if ($handle = opendir(__DIR__ . "/js")) {

  while (false !== ($entry = readdir($handle))) {
   if ($entry != "." && $entry != "..") {
    if (!str_contains($entry, "map")) {
     echo "
<script src='" . DOMAIN . "/assets/admin/js/$entry' type='text/javascript'></script>";
    }
   }
  }
  closedir($handle);
 }
}
