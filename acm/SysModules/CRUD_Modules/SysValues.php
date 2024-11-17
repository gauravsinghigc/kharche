<?php
//configuration
function CONFIG($Data, $die = false)
{
 $SQL = "SELECT * FROM configurations where configurationname='$Data'";

 //die entry
 if ($die == true) {
  die(SELECT($SQL, true));
 }

 $CheckSQLCommand = CHECK($SQL);
 if ($CheckSQLCommand == false) {
  $Value = null;
 } else {
  $Value = FETCH($SQL, "configurationvalue");
 }

 return $Value;
}
