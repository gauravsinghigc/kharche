<?php
if ($handle = opendir(__DIR__ . "/admin")) {

 while (false !== ($entry = readdir($handle))) {
  if ($entry != "." && $entry != "..") {
   if (!str_contains($entry, "map")) {
    include __DIR__ . "/admin/$entry";
   }
  }
 }
 closedir($handle);
}
