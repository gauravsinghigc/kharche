<?php
//initialize files
require "../../acm/SysFileAutoLoader.php";
require "../../acm/SystemReqHandler.php";
require "../AuthController/AuthAccessController.php";

if (isset($_POST['CreateCustomer'])) {

    $customers = [
        "customer_name" => $_POST['customer_name'],
        "customer_display_name" => $_POST['customer_display_name'],
        "customer_phone_number" => $_POST['customer_phone_number'],
        "customer_email_id" => $_POST['customer_email_id'],
        "customer_date_of_birth" => $_POST['customer_date_of_birth'],
        "customer_street_address" => SECURE($_POST['customer_street_address'], "e"),
        "customer_area" => $_POST['customer_area'],
        "customer_state" => $_POST['customer_state'],
        "customer_city" => $_POST['customer_city'],
        "customer_pincode" => $_POST['customer_pincode'],
        "customer_added_at" => CURRENT_DATE_TIME,
        "customer_updated_at" => CURRENT_DATE_TIME,
        "customer_main_user_id" => LOGIN_USER_ID,
        "customer_profile_image" => UPLOAD_FILES("../../storage/users/img", null, "" . $_POST['customer_phone'] . "" . $_POST['customer_phone_number'], "customer_profile_image"),
    ];
    $Response = INSERT("customers", $customers);
    RESPONSE($Response, "Customers details are saved successfully!", "Unable to save customers details at the moment!");

    //update customer details
} elseif (isset($_POST['UpdateCustomerDetails'])) {
    $customer_id = SECURE($_POST['customer_id'], "d");

    $customers = [
        "customer_name" => $_POST['customer_name'],
        "customer_display_name" => $_POST['customer_display_name'],
        "customer_phone_number" => $_POST['customer_phone_number'],
        "customer_email_id" => $_POST['customer_email_id'],
        "customer_date_of_birth" => $_POST['customer_date_of_birth'],
        "customer_street_address" => SECURE($_POST['customer_street_address'], "e"),
        "customer_area" => $_POST['customer_area'],
        "customer_state" => $_POST['customer_state'],
        "customer_city" => $_POST['customer_city'],
        "customer_pincode" => $_POST['customer_pincode'],
        "customer_updated_at" => CURRENT_DATE_TIME,
    ];
    $Response = UPDATE_TABLE("customers", $customers, "customer_id='$customer_id'");
    RESPONSE($Response, "Customers details are update successfully!", "Unable to update customers details at the moment!");
}
