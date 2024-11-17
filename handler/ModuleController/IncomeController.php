<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";

if (isset($_POST['CreateIncomeEntery'])) {

 $data = array(
  "IncomeMainUserId" => SECURE($_POST['IncomeMainUserId'], "d"),
  "IncomeName" => $_POST['IncomeName'],
  "IncomeTags" => $_POST['IncomeTags'],
  "IncomeSource" => $_POST['IncomeSource'],
  "IncomeAmount" => $_POST['IncomeAmount'],
  "IncomeNotes" => SECURE($_POST['IncomeNotes'], "e"),
  "IncomeReceiveDate" => $_POST['IncomeReceiveDate'],
  "IncomeCreatedAt" => CURRENT_DATE_TIME,
  "IncomeUpdatedAt" => CURRENT_DATE_TIME,
  "IncomeGroup" => DATE_FORMATES("Y-M", $_POST['IncomeReceiveDate'])
 );
 $Response = INSERT("income", $data);

 $TransactionMainRefId = FETCH("SELECT * FROM income ORDER BY IncomeId DESC limit 0,1", "IncomeId");
 $transactions = array(
  "TransactionMainUserId" => SECURE($_POST['IncomeMainUserId'], "d"),
  "TransactionType" => "INCOME",
  "TransactionName" => $_POST['IncomeName'],
  "TransactionCategory" => $_POST['IncomeSource'],
  "Transactiontags" => $_POST['IncomeTags'],
  "TransactionNotes" => SECURE($_POST['IncomeNotes'], "e"),
  "TransactionDate" => $_POST['IncomeReceiveDate'],
  "TransactionCreatedAt" => CURRENT_DATE_TIME,
  "TransactionUpdatedAt" => CURRENT_DATE_TIME,
  "TransactionMainRefId" => $TransactionMainRefId,
  "TransactionGroup" => DATE_FORMATES("Y-M", $_POST['IncomeReceiveDate']),
  "TransactionAmount" => $_POST['IncomeAmount']
 );
 $Response = INSERT("transactions", $transactions);

 $True = "Income Entery of amount " . $_POST['IncomeAmount'] . " for" . $_POST['IncomeReceivedDate'] . " is saved successfully!";
 $False = "Unable to save income entry at the moment!";


 //update income details
} elseif (isset($_POST['UpdateIncomeEntery'])) {
 $IncomeId = SECURE($_POST['IncomeId'], "d");

 $data = array(
  "IncomeName" => $_POST['IncomeName'],
  "IncomeTags" => $_POST['IncomeTags'],
  "IncomeSource" => $_POST['IncomeSource'],
  "IncomeAmount" => $_POST['IncomeAmount'],
  "IncomeNotes" => SECURE($_POST['IncomeNotes'], "e"),
  "IncomeReceiveDate" => $_POST['IncomeReceiveDate'],
  "IncomeUpdatedAt" => CURRENT_DATE_TIME,
  "IncomeGroup" => DATE_FORMATES("Y-M", $_POST['IncomeReceiveDate'])
 );
 $Response = UPDATE_TABLE("income", $data, "IncomeId='$IncomeId'");

 $transactions = array(
  "TransactionType" => "INCOME",
  "TransactionName" => $_POST['IncomeName'],
  "TransactionCategory" => $_POST['IncomeSource'],
  "Transactiontags" => $_POST['IncomeTags'],
  "TransactionNotes" => SECURE($_POST['IncomeNotes'], "e"),
  "TransactionDate" => $_POST['IncomeReceiveDate'],
  "TransactionUpdatedAt" => CURRENT_DATE_TIME,
  "TransactionMainRefId" => $IncomeId,
  "TransactionGroup" => DATE_FORMATES("Y-M", $_POST['IncomeReceiveDate']),
  "TransactionAmount" => $_POST['IncomeAmount']
 );
 $Response = UPDATE_TABLE("transactions", $transactions, "TransactionMainRefId='$IncomeId'");

 $True = "Income Entery of amount " . $_POST['IncomeAmount'] . " for " . $_POST['IncomeReceivedDate'] . " is updated successfully!";
 $False = "Unable to update income entry at the moment!";

 //remove income
} elseif (isset($_GET['remove_income_record'])) {
 $access_url = SECURE($_GET['access_url'], "d");
 $remove_income_record = SECURE($_GET['remove_income_record'], "d");

 if ($remove_income_record == true) {
  $control_id = SECURE($_GET['control_id'], "d");
  $Response = DELETE_FROM("income", "IncomeId='$control_id'");
  $Response = DELETE_FROM("transactions", "TransactionMainRefId='$control_id'");
  $True = "Income Record Removed!";
  $access_url = WEB_URL . "/expanses.php";
 } else {
  $Response = false;
  $False = "Unable to remove income record!";
 }
}


//send response to Origion
RESPONSE($Response, $True, $False);
