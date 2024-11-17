<script>
    function SearchData(searchinput, items_box) {
        // Get the search input
        var searchInput = document.getElementById("" + searchinput + "").value;

        // Get all content items
        var contentItems = document.getElementsByClassName("" + items_box + "");

        // Loop through all content items
        for (var i = 0; i < contentItems.length; i++) {
            // Get the current item
            var item = contentItems[i];

            // Get the text of the current item
            var itemText = item.textContent.toLowerCase();

            // Check if the search input is found in the item text
            if (itemText.includes(searchInput.toLowerCase())) {
                // If found, show the item
                item.style.display = "block";
            } else {
                // If not found, hide the item
                item.style.display = "none";
            }
        }
    }
</script>
<script src="<?php echo ASSETS_URL; ?>/lib/jquery/jquery.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/lib/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/lib/jqvmap/maps/jquery.vmap.world.js"></script>
<script src="<?php echo ASSETS_URL; ?>/lib/apexcharts/apexcharts.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/script.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/app.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/db.data.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/db.analytics.js"></script>