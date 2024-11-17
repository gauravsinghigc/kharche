<?php
//auto load required files
require "../acm/SysFileAutoLoader.php";

//computer view access manager
if (WEBSITE == "true") {
 header("location: " . DOMAIN . "/in");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <title>Coming Soon | <?php echo APP_NAME; ?></title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <?php SystemHeaderFiles(); ?>
</head>

<body class="sys-bg">
 <section class="container mt-3">
  <div class="row mt-3">
   <div class="col-md-12 text-center mt-3">
    <img src="https://www.pngall.com/wp-content/uploads/2016/05/Coming-Soon-PNG.png" class="w-25 mb-2 mt-5"><br>
    <img src="<?php echo APP_LOGO; ?>" class="w-25 mt-5">
    <p>Something very awesome is on the way, when it is live we will update you asap.</p>

    <form class="w-25 d-block mx-auto">
     <input type="email" class="form-control-sm form-control" name="email" placeholder="Drop Your Email">
     <button class="btn btn-sm btn-success mt-2"><i class="fa fa-thumbs-up"></i> Update Me</button>
    </form>
   </div>
  </div>
 </section>

 <?php include "../include/common/sys-developer-footer.php"; ?>
</body>
<?php SystemFooterFiles(); ?>

</html>