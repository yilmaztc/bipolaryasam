<?php
    get_header();
?>
    <div class="container bp_slider_content">
        <div class="row">
            <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
                <?php
                    if ( function_exists( "nav_menu_ms" ) ) {
                        $top_menu_args = array( "bottom-menu", false, "menu_index_bp bp_ul_default", "menu_index" );
                        nav_menu_ms( $top_menu_args );
                    }
                ?>
            </div>
            <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
                <?php
                    if(function_exists("BipolarContentSlider"))
                        BipolarContentSlider();
                ?>
            </div>
        </div>
    </div>
<?php
    get_footer();
?>