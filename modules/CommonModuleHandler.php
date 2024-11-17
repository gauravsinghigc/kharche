<?php
if ($handle = opendir(__DIR__ . "/common")) {

 while (false !== ($entry = readdir($handle))) {
  if ($entry != "." && $entry != "..") {
   if (!str_contains($entry, "map")) {
    include __DIR__ . "/common/$entry";
   }
  }
 }
 closedir($handle);
}
