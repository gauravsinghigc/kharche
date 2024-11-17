<?php

/**
 * @AdminFooterFiles
 */

function MainFooterFiles()
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
<script src='" . DOMAIN . "/assets/main/js/$entry' type='text/javascript'></script>";
        }
      }
    }
    closedir($handle);
  }
}
