<?php
//remove space
function RemoveSpace($string)
{
 $string = str_replace(' ', '-', $string);
 if ($string == null) {
  return null;
 } else {
  return $string;
 }
}

//lowercase all words
function LowerCase($string)
{
 $string = strtolower($string);
 if ($string == null) {
  return null;
 } else {
  return $string;
 }
}

//uppercase all words
function UpperCase($string)
{
 $string = strtoupper($string);
 if ($string == null) {
  return null;
 } else {
  return $string;
 }
}

//GET numbers from strings
function GetNumbers($strings)
{
 if ($strings == null) {
  $return = 0;
 } else {
  $return = intval(preg_replace('/[^0-9]+/', '', $strings), 10);
 }

 return $return;
}
