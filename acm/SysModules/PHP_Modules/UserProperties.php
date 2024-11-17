<?php
//user per missions
define("USER_PERMISSIONS", array(
 "VIEW", "EDIT", "DELETE_TEMP", "IMPORT", "EXPORT_PDF", "DELETE_PERM", "INSERT", "VIEW_ALL", "VIEW_RELATIVE", "DEVELOPER",
 "TRANSFER_ALL", "TRANSFER_RELATIVE", "EXPORT_CSV", "PRINT_OPTION", "STATUS_UPDATE" . "DEFLAUT_VIEW", "DATA_PREVIEW", "UPLOAD_SINGLE",
 "UPLOAD_MULTIPLE", "CANCEL", "PASSWORD_CHANGE_OPTION"
));

//user roles
define("USER_ROLES", array(
 "SUPER_ADMIN" => "Super Admin",
 "ADMIN" => "Administrator",
 "TEAM_MEMBER" => "Team Member",
 "HR" => "Human Resource (HR)",
 "ACCOUNTS" => "Accounts",
 "CUSTOMERS" => "Customers",
 "VENDORS" => "Vendors",
 "SUPPORT_EXECUTIVE" => "Support Executive",
 "RECEPTIONIST" => "Receptionist",
 "DIRECTOR" => "Director",
 "TEAM_LEADER" => "Team Leader",
 "AREA_MANAGER" => "Area Manager",
 "SALES_MANAGER" => "Sales Manager",
 "PROJECT_MANAGER" => "Project Manager",
 "LEAD_MANAGER" => "Leader Manager",
));

//user genders
define("USER_GENDER", array("Male", "Female", "Others"));

//user salutation 
define("SALUTATION", array("Mr.", "Mrs.", "Miss", "M/s", "Prof", "Dr."));
