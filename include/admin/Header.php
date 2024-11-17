<header class="sys-bg" id="header">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-12">
    <div class="flex-s-b">
     <div class="sys-intro">
      <img src="<?php echo APP_LOGO; ?>" alt="<?php echo APP_NAME; ?>" title="<?php echo APP_NAME; ?>">
      <h6><?php echo APP_NAME; ?></h6>
     </div>
     <div class="user-intro">
      <div class="sys-user-profile">
       <a href='<?php echo ADMIN_URL; ?>/profile/'>
        <img src="<?php echo AuthUser("UserProfileImage"); ?>">
       </a>
       <a href="<?php echo ADMIN_URL; ?>/profile/">
        <h6><?php echo AuthUser("UserFullName"); ?></h6>
       </a>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</header>