<?php
$Dir = "../../../";
require $Dir . "/acm/SysFileAutoLoader.php";
require $Dir . "/handler/AuthController/AuthAccessController.php";
$PageName = "Create Customers";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="<?php echo APP_NAME; ?>">

    <title>Profile - <?php echo APP_NAME; ?></title>
    <?php include  $Dir . "assets/HeaderFiles.php"; ?>
    <script>
        window.onload = function() {
            document.getElementById("customers").classList.add("active");
        }
    </script>
</head>

<body>
    <?php
    include $Dir . "include/Sidebar.php";
    include $Dir . "include/Header.php";
    ?>
    <div class="main main-app p-lg-5">
        <div class="container-fluid">
            <form class="row" action='<?php echo CONTROLLER; ?>/ModuleController/CustomerController.php' method="POST" enctype="multipart/form-data">
                <?php FormPrimaryInputs(true); ?>
                <div class="col-md-4 row">
                    <div class="col-md-12">
                        <h5 class="app-text mt-2">Upload Photo</h5>
                    </div>
                    <div class="col-md-12 text-center mb-4">
                        <input hidden type='file' name='customer_profile_image' id='customer_profile_image' accept="image/*">
                        <label for='customer_profile_image'>
                            <img src="<?php echo STORAGE_URL_D; ?>/tool-img/user-upload.jpg" id='UploadFile' class='w-50 rounded-circle app-border p-3'>
                        </label>
                    </div>
                </div>

                <div class='col-md-6 row'>
                    <div class="col-md-12">
                        <h5 class="app-text">Primary Info</h5>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Full name</label>
                        <input type="text" name='customer_name' class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Display Name</label>
                        <input type="text" name='customer_display_name' class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Phone number</label>
                        <input type="tel" name='customer_phone_number' class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Email-Id</label>
                        <input type="email" name='customer_email_id' class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Date of Birth</label>
                        <input type='date' name='customer_date_of_birth' class='form-control' value='<?php echo date('Y-m-d'); ?>'>
                    </div>
                </div>

                <div class="col-md-6 row">
                    <div class="col-md-12">
                        <h5 class="app-text mt-5">Address</h5>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Address</label>
                        <textarea name='customer_street_address' class="form-control" rows="3"></textarea>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Area/Sector</label>
                        <input type="text" name='customer_area' class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>State</label>
                        <input type="text" name='customer_state' class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>City</label>
                        <input type="text" name='customer_city' class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Pincode</label>
                        <input type="text" name='customer_pincode' class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-center mb-4 mt-2">
                        <button type='submit' name='CreateCustomer' class="btn btn-success btn-lg">Save Details <i class='ri-check-double-line'></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        customer_profile_image.onchange = evt => {
            const [file] = customer_profile_image.files
            if (file) {
                UploadFile.src = URL.createObjectURL(file);
            }
        }
    </script>

    <?php
    include $Dir . "assets/FooterFiles.php";
    ?>

</body>

</html>