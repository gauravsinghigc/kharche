<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";

if (isset($_POST['SaveEnquiry'])) {

 $Enquiry = array(
  "EnqFullname" => $_POST['EnqFullname'],
  "EnqEmailId" => $_POST['EnqEmailId'],
  "EnqPhoneNumber" => $_POST['EnqPhoneNumber'],
  "EnqDetails" => SECURE($_POST['EnqDetails'], "e"),
  "EnqCreatedAt" => CURRENT_DATE_TIME,
  "EnqUpdatedAt" => CURRENT_DATE_TIME,
  "EnqStatus" => "NEW"
 );
 $EMAILTEMPlates = "<h3>Enquiry Details:</h3>";
 $EMAILTEMPlates .= "<p>";
 $EMAILTEMPlates .= "<span style='color:grey;'>Person Name</span><br><b>" . $_POST['EnqFullname'] . "</b><br>";
 $EMAILTEMPlates .= "<span style='color:grey;'>Phone No</span><br><b>" . $_POST['EnqPhoneNumber'] . "</b><br>";
 $EMAILTEMPlates .= "<span style='color:grey;'>Email id</span><br><b>" . $_POST['EnqEmailId'] . "</b><br>";
 $EMAILTEMPlates .= "<span style='color:grey;'>Message</span><br><b>" . $_POST['EnqDetails'] . "</b><br>";
 $EMAILTEMPlates .= "<span style='color:grey;'>Sent On</span><br><b>" . DATE_FORMATES("d M, Y h:i A", CURRENT_DATE_TIME) . "</b><br>";
 $EMAILTEMPlates .= "</p>";

 $Response = INSERT("enquiries", $Enquiry);

 if ($Response == true) {
  SENDMAILS("New Enquiry Received!", APP_NAME . " Team", "kharche@gauravsinghigc.in", $EMAILTEMPlates);
 }
 RESPONSE($Response, "Thanking you for get contact us, we will contact you as soon as possible!", "Unable to send enquiry details at the moment!");
}
