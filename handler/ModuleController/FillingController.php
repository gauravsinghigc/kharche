<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";
require "../../modules/common/AuthUserModules.php";


if (isset($_POST['CreateFillingRecord'])) {

  $data = array(
    "MainVehicleId" => $_POST['MainVehicleId'],
    "FillingOdoMeterReading" => $_POST['FillingOdoMeterReading'],
    "FillingQuantity" => $_POST['FillingQuantity'],
    "FilledFuelType" => $_POST['FilledFuelType'],
    "FillingPricePerLiter" => round($_POST['FillingPricePerLiter'], 2),
    "FillingNetPrice" => round($_POST['FillingNetPrice'], 2),
    "FillingDate" => $_POST['FillingDate'],
    "FillingTime" => $_POST['FillingTime'],
    "FillingStationName" => $_POST['FillingStationName'],
    "FillingCreatedAt" => CURRENT_DATE_TIME,
    "FillingUpdateAt" => CURRENT_DATE_TIME,
    "FillingGroup" => DATE_FORMATES("Y-m", $_POST['FillingDate']),
    "FilledDistanceKm" => $_POST['FillingOdoMeterReading'] - FETCH("SELECT * FROM fillings where MainVehicleId='" . $_POST['MainVehicleId'] . "' ORDER BY FillingId DESC limit 0, 1", "FillingOdoMeterReading"),
    "FilledPreviousQty" => $_POST['CurrentFillingLevel'],
  );
  $save = INSERT("fillings", $data);

  $ExpanseMainUserId = FETCH("SELECT * FROM vehicles where VehicleId='" . $_POST['MainVehicleId'] . "'", "MainUserId");
  $ExpanseNotes = $_POST['FillingQuantity']
    . " " . $_POST['FilledFuelType']
    . " fuel at " . $_POST['FillingOdoMeterReading']
    . " with rate of " . AuthAppUser("UserPriceType")
    . "/" . $_POST['FillingPricePerLiter'] . " "
    . " " . $_POST['FilledFuelType'] . ""
    . " which cost " . AuthAppUser("UserPriceType")
    . "" . $_POST['FillingNetPrice'] . " on"
    . " " . $_POST['FillingDate'] . " " . $_POST['FillingTime']
    . " from " . $_POST['FillingStationName'];

  $expanses = array(
    "ExpanseMainUserId" => $ExpanseMainUserId,
    "ExpanseName" => "FUEL @ " . $_POST['FillingOdoMeterReading'] . " - " . $_POST['FillingQuantity'] . " " . $_POST['FilledFuelType'],
    "ExpanseCategory" => "TRANSPORTATION",
    "ExpanseTags" => "FUEL REFILLING",
    "ExpanseNotes" => SECURE($ExpanseNotes, "e"),
    "ExpanseDate" => $_POST['FillingDate'],
    "ExpanseAmount" => $_POST['FillingNetPrice'],
    "ExpanseCreatedAt" => CURRENT_DATE_TIME,
    "ExpanseCreatedAt" => CURRENT_DATE_TIME,
    "ExpanseGroup" => DATE_FORMATES("Y-M", $_POST['FillingDate'])
  );
  $Response = INSERT("expanses", $expanses);

  $TransactionMainRefId = FETCH("SELECT * FROM expanses ORDER BY ExpansesId DESC limit 0,1", "ExpansesId");
  $transactions = array(
    "TransactionMainUserId" => $ExpanseMainUserId,
    "TransactionType" => "EXPANSE",
    "TransactionName" => "<i class='fa fa-gas-pump'></i> Fuel Filling",
    "TransactionCategory" => "TRANSPORTATION",
    "Transactiontags" => "FUEL REFILLING",
    "TransactionNotes" => SECURE($ExpanseNotes, "e"),
    "TransactionDate" => $_POST['FillingDate'],
    "TransactionCreatedAt" => CURRENT_DATE_TIME,
    "TransactionUpdatedAt" => CURRENT_DATE_TIME,
    "TransactionMainRefId" => $TransactionMainRefId,
    "TransactionGroup" => DATE_FORMATES("Y-M", $_POST['FillingDate']),
    "TransactionAmount" => $_POST['FillingNetPrice']
  );
  $Response = INSERT("transactions", $transactions);

  RESPONSE($save, "New filling record saved successfully!", "unable to save new filling record!");

  //update filling record
} elseif (isset($_POST['UpdateFillingRecord'])) {
  $FillingId = secure($_POST['FillingId'], "d");
  $data = array(
    "FillingOdoMeterReading" => $_POST['FillingOdoMeterReading'],
    "FillingQuantity" => $_POST['FillingQuantity'],
    "FilledFuelType" => $_POST['FilledFuelType'],
    "FillingPricePerLiter" => round($_POST['FillingPricePerLiter'], 2),
    "FillingNetPrice" => round($_POST['FillingNetPrice'], 2),
    "FillingDate" => $_POST['FillingDate'],
    "FillingTime" => $_POST['FillingTime'],
    "FillingStationName" => $_POST['FillingStationName'],
    "FillingUpdateAt" => CURRENT_DATE_TIME,
    "FillingGroup" => DATE_FORMATES("Y-m", $_POST['FillingDate']),
    "FilledDistanceKm" => $_POST['FillingOdoMeterReading'] - (int)FETCH("SELECT * FROM fillings where FillingId!='$FillingId' and FillingId<='$FillingId' and MainVehicleId='" . $_POST['MainVehicleId'] . "' ORDER BY FillingId DESC limit 0, 1", "FillingOdoMeterReading"),
    "FilledPreviousQty" => $_POST['CurrentFillingLevel']
  );
  $save = UPDATE_TABLE("fillings", $data, "FillingId='$FillingId'");
  RESPONSE($save, "filling record updated successfully!", "unable to update filling record!");

  //remove filling record
} elseif (isset($_GET['remove_vehicle_filling_record'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $remove_vehicle_filling_record = SECURE($_GET['remove_vehicle_filling_record'], "d");

  if ($remove_vehicle_filling_record == "true") {
    $FillingId = SECURE($_GET['FillingId'], "d");
    $Delete = DELETE_FROM("fillings", "FillingId='$FillingId'");
    $access_url = WEB_URL . "/fuel.php";
  } else {
    $Delete = false;
  }
  RESPONSE($Delete, "Filling record is deleted successfully.", "Unable to delete Filling entry!");
}
