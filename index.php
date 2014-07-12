<?php
get_header();
?>
<div class="container bp_slider_content">
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12">
            <?php
            if (function_exists("nav_menu_ms")) {
                $top_menu_args = array("bottom-menu", false, "menu_index_bp bp_ul_default", "menu_index");
                nav_menu_ms($top_menu_args);
            }
            ?>
        </div>
        <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12">
            <?php
            if (function_exists("BipolarContentSlider"))
                BipolarContentSlider();
            ?>
        </div>
    </div>
    <div class="index_bottom">
        <div class="col-lg-4 col-md-4 index_contact">
            <h3>Hızlı İletişim</h3>
            <span class="index_ucgen"></span>
            <span class="index_cizgi"></span>
            <?php
                if( function_exists( "main_form_area" ) ){
                    main_form_area(array(
                        'display' => false,
                        'address' => true,
                        'maps' => false
                    ));
                }
            ?>
        </div>
        <ul class="col-lg-3 col-md-3 index_list">
            <li class="index_list_h"><span>Sizin Hikayeleriniz</span></li>
            <li class="index_list_u"><span>Uzmanlar Ne diyor?</span></li>
            <li class="index_list_d"><span>Dernek ve Gönüllülük</span></li>
        </ul>
    </div>
</div>
<?php
get_footer();
?>