<?php

//controller request
function CONTROLLER($controllername = null)
{

 if ($controllername == null) {
  $controller = "";
 } else {
  $controller = CONTROLLER . "/" . $controllername;
 }

 return $controller;
}
