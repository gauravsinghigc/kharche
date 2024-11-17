<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";
require "../../modules/common/AuthUserModules.php";


if (isset($_POST['CreateVehicleDetails'])) {

 $data = array(
  "MainUserId" => SECURE($_POST['MainUserId'], "d"),
  "VehcileType" => $_POST['VehcileType'],
  "VehcileFuelType" => $_POST['VehcileFuelType'],
  "VehcileName" => $_POST['VehcileName'],
  "VehicleBrandName" => $_POST['VehicleBrandName'],
  "VehicleModalNo" => $_POST['VehicleModalNo'],
  "VehicleRegNo" => UpperCase($_POST['VehicleRegNo']),
  "VehicleEngineNo" => UpperCase($_POST['VehicleEngineNo']),
  "VehicleChasisNo" => UpperCase($_POST['VehicleChasisNo']),
  "VehicleCreatedAt" => CURRENT_DATE_TIME,
  "VehicleUpdatedAt" => CURRENT_DATE_TIME,
  "VehicleStatus" => true,
  "VehicleMaxFuel" => $_POST['VehicleMaxFuel'],
 );
 $Save = INSERT("vehicles", $data);
 RESPONSE($Save, "New vehicles is added successfully.", "Unable to save new vehicle at the moment!");

 //update vehicle details
} elseif (isset($_POST['UpdateVehicleDetails'])) {
 $VehicleId = SECURE($_POST['VehicleId'], "d");
 $data = array(
  "VehcileType" => $_POST['VehcileType'],
  "VehcileFuelType" => $_POST['VehcileFuelType'],
  "VehcileName" => $_POST['VehcileName'],
  "VehicleBrandName" => $_POST['VehicleBrandName'],
  "VehicleModalNo" => $_POST['VehicleModalNo'],
  "VehicleRegNo" => UpperCase($_POST['VehicleRegNo']),
  "VehicleEngineNo" => UpperCase($_POST['VehicleEngineNo']),
  "VehicleChasisNo" => UpperCase($_POST['VehicleChasisNo']),
  "VehicleUpdatedAt" => CURRENT_DATE_TIME,
  "VehicleStatus" => true,
  "VehicleMaxFuel" => $_POST['VehicleMaxFuel'],
 );
 $Save = UPDATE_TABLE("vehicles", $data, "VehicleId='$VehicleId'");
 RESPONSE($Save, "Vehicles details is updated successfully.", "Unable to update vehicle at the moment!");

 //remove record
} elseif (isset($_GET['remove_vehicle_record'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $remove_vehicle_record = SECURE($_GET['remove_vehicle_record'], "d");

 if ($remove_vehicle_record == "true") {
  $vehicle_id = SECURE($_GET['vehicle_id'], "d");
  $Delete = DELETE_FROM("vehicles", "VehicleId='$vehicle_id'");
  $access_url = WEB_URL . "/vehicles.php";
 } else {
  $Delete = false;
 }
 RESPONSE($Delete, "Vehicle record is deleted successfully.", "Unable to delete vehilce entry!");
}
