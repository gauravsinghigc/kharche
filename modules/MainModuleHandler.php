<?php
if ($handle = opendir(__DIR__ . "/main")) {

 while (false !== ($entry = readdir($handle))) {
  if ($entry != "." && $entry != "..") {
   if (!str_contains($entry, "map")) {
    include __DIR__ . "/main/$entry";
   }
  }
 }
 closedir($handle);
}
