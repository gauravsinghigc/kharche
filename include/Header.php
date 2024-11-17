 <div class="header-main px-3 px-lg-4">
   <div class='p-heading'>
     <a id="menuSidebar" href="#" class="menu-link me-3 me-lg-4"><i class="ri-menu-2-fill"></i></a>
     <h2><?php echo $PageName; ?>
       <span class="app-text">.</span>
     </h2>
   </div>

   <div class="dropdown dropdown-profile ms-3 ms-xl-4 pull-right">
     <a href="<?php echo DOMAIN; ?>/app/profile">
       <div class="avatar online">
         <img src="<?php echo AuthAppUser("UserProfileImage"); ?>" alt="">
       </div>
     </a>
   </div><!-- dropdown -->
 </div>