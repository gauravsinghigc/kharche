<?php
//date formates
function DATE_FORMATES($format, $date)
{
 $newdateformate = $date;
 if ($date == null  || $date == "" || $date == "0000-00-00" || $date == " ") {
  $newdateformate = "No Update";
 } else {
  $newdateformate = date("$format", strtotime($date));
 }
 return $newdateformate;
}

/**
 * Current Date time 
 * You can call any of these date, time, or both at same time via CONSTANT DECLARATION METHOD
 */

DEFINE("CURRENT_DATE_TIME", date('Y-m-d h:i:s A'));
DEFINE("CURRENT_DATE", date('Y-m-d'));
DEFINE("CURRENT_TIME", date('h:i:s A'));
