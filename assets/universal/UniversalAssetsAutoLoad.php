<?php

/**
 * @load Universal Files
 * @SystemHeaderFiles
 * @SystemFooterFiles
 */

function SystemHeaderFiles()
{

   //external css links
   $ExternalCssLinks = array(
      "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css",
   );

   //load favicon icon for the applications
   echo '<link rel="icon" href="' . APP_LOGO . '" />';

   //captured
   foreach ($ExternalCssLinks as $CssLinks) {
      echo
      '<link rel="stylesheet" href="' . $CssLinks . '" />';
   }

   if ($handle = opendir(__DIR__ . "/css")) {

      while (false !== ($entry = readdir($handle))) {
         if ($entry != "." && $entry != "..") {
            if (!str_contains($entry, "map")) {
               echo "
<link rel='stylesheet' href='" . DOMAIN . "/assets/universal/css/$entry' type='text/css'> ";
            }
         }
      }
      closedir($handle);
   }
}


function SystemFooterFiles()
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
<script src='" . DOMAIN . "/assets/universal/js/$entry' type='text/javascript'></script>";
            }
         }
      }
      closedir($handle);
   }
}
