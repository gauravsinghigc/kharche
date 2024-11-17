<?php

/**
 * @AdminHeaderFiles
 */

function AdminHeaderFiles()
{

    //external css links
    $ExternalCssLinks = array();

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
<link rel='stylesheet' href='" . DOMAIN . "/assets/admin/css/$entry' type='text/css'> ";
                }
            }
        }
        closedir($handle);
    }
}
