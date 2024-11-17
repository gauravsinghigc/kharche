<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";

if (isset($_POST['CreateExpanseEntery'])) {

  $data = array(
    "ExpanseMainUserId" => SECURE($_POST['ExpanseMainUserId'], "d"),
    "ExpanseName" => $_POST['ExpanseName'],
    "ExpanseCategory" => $_POST['ExpanseCategory'],
    "ExpanseTags" => $_POST['ExpanseTags'],
    "ExpanseNotes" => SECURE($_POST['ExpanseNotes'], "e"),
    "ExpanseDate" => $_POST['ExpanseDate'],
    "ExpanseAmount" => $_POST['ExpanseAmount'],
    "ExpanseCreatedAt" => CURRENT_DATE_TIME,
    "ExpanseUpdateAt" => CURRENT_DATE_TIME,
    "ExpanseGroup" => DATE_FORMATES("Y-M", $_POST['ExpanseDate'])
  );
  $Response = INSERT("expanses", $data);

  $TransactionMainRefId = FETCH("SELECT * FROM expanses ORDER BY ExpansesId DESC limit 0,1", "ExpansesId");
  $transactions = array(
    "TransactionMainUserId" => SECURE($_POST['ExpanseMainUserId'], "d"),
    "TransactionType" => "EXPANSE",
    "TransactionName" => $_POST['ExpanseName'],
    "TransactionCategory" => $_POST['ExpanseCategory'],
    "Transactiontags" => $_POST['ExpanseTags'],
    "TransactionNotes" => SECURE($_POST['ExpanseNotes'], "e"),
    "TransactionDate" => $_POST['ExpanseDate'],
    "TransactionCreatedAt" => CURRENT_DATE_TIME,
    "TransactionUpdatedAt" => CURRENT_DATE_TIME,
    "TransactionMainRefId" => $TransactionMainRefId,
    "TransactionGroup" => DATE_FORMATES("Y-M", $_POST['ExpanseDate']),
    "TransactionAmount" => $_POST['ExpanseAmount']
  );
  $Response = INSERT("transactions", $transactions);

  $True = "Expanse Entery of amount " . $_POST['ExpanseAmount'] . " for" . $_POST['ExpanseDate'] . " is saved successfully!";
  $False = "Unable to save expanse entry at the moment!";

  //update
} elseif (isset($_POST['UpdateExpanseEntery'])) {
  $ExpansesId = SECURE($_POST['ExpansesId'], "d");

  $data = array(
    "ExpanseName" => $_POST['ExpanseName'],
    "ExpanseCategory" => $_POST['ExpanseCategory'],
    "ExpanseTags" => $_POST['ExpanseTags'],
    "ExpanseNotes" => SECURE($_POST['ExpanseNotes'], "e"),
    "ExpanseDate" => $_POST['ExpanseDate'],
    "ExpanseAmount" => $_POST['ExpanseAmount'],
    "ExpanseUpdateAt" => CURRENT_DATE_TIME,
    "ExpanseGroup" => DATE_FORMATES("Y-M", $_POST['ExpanseDate'])
  );
  $Response = UPDATE_TABLE("expanses", $data, "ExpansesId='$ExpansesId'");

  $transactions = array(
    "TransactionType" => "EXPANSE",
    "TransactionName" => $_POST['ExpanseName'],
    "TransactionCategory" => $_POST['ExpanseCategory'],
    "Transactiontags" => $_POST['ExpanseTags'],
    "TransactionNotes" => SECURE($_POST['ExpanseNotes'], "e"),
    "TransactionDate" => $_POST['ExpanseDate'],
    "TransactionUpdatedAt" => CURRENT_DATE_TIME,
    "TransactionMainRefId" => $ExpansesId,
    "TransactionGroup" => DATE_FORMATES("Y-M", $_POST['ExpanseDate']),
    "TransactionAmount" => $_POST['ExpanseAmount']
  );
  $Response = UPDATE_TABLE("transactions", $transactions, "TransactionMainRefId='$ExpansesId'");

  $True = "Expanse Entery of amount " . $_POST['ExpanseAmount'] . " for" . $_POST['ExpanseDate'] . " is updated successfully!";
  $False = "Unable to update expanse entry at the moment!";

  //remove expanse record
} elseif (isset($_GET['remove_expanse_record'])) {
  $access_url = SECURE($_GET['access_url'], "d");
  $remove_expanse_record = SECURE($_GET['remove_expanse_record'], "d");

  if ($remove_expanse_record == true) {
    $control_id = SECURE($_GET['control_id'], "d");
    $Response = DELETE_FROM("expanses", "ExpansesId='$control_id'");
    $Response = DELETE_FROM("transactions", "TransactionMainRefId='$control_id'");
    $True = "Expanse Record Removed!";
    $access_url = WEB_URL . "/expanses.php";
  } else {
    $Response = false;
    $False = "Unable to remove expanse record!";
  }
}









//send response to Origion
RESPONSE($Response, $True, $False);
