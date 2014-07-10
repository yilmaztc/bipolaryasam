<?php
get_header();
?>
<div class="container">
    <div class="row">
        <div class="index-menu">
            <?php
            if (function_exists("nav_menu_ms")) {
                $top_menu_args = array("bottom-menu", false, "menu_index_bp", "menu_index");
                nav_menu_ms($top_menu_args);
            }
            ?>
        </div>
        <div class="bp_slider">
            <?php include (TEMPLATEPATH . '/inc/slider/slider.php'); ?>
        </div>
    </div></div>
<?php
get_footer();
?>