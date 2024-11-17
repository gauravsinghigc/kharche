<?php include __DIR__ . "/Loader.php"; ?>
<div class="sidebar">
  <div class="sidebar-header">
    <a href="<?php echo ROOT; ?>/app" class="sidebar-logo">
      <img src="<?php echo APP_LOGO; ?>" class="img-fluid w-50">
    </a>
  </div>
  <div id="sidebarMenu" class="sidebar-body">
    <?php include __DIR__ . "/sidebars/user-sidebar.php"; ?>
  </div>
</div>