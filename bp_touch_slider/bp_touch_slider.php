<?php
    wp_enqueue_script( "bp_touch_slider_script", get_template_directory_uri() . '/inc/slider/slider.js' );
    wp_enqueue_style( "bp_touch_slider_style", get_stylesheet_directory_uri() . "/inc/slider/style.css" );
?>
<?php function BipolarContentSlider()
{ ?>
    <div id="bp_content_slider">
        <ul class="bp_content_slider bp_ul_default">
            <?php
                for ( $i = 1 ; $i <= 6 ; $i++ ) {
                    ?>
                    <li>
                        <a href="javascrip:void(0)">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/inc/img/slider_auto_image.jpg" alt=""/>
                        </a>
                        <article class="slider-title">
                            <h3>Örnek Haber Başlığı <?php echo $i ?></h3>
                        </article>
                    </li>
                <?php
                }
            ?>
        </ul>
        <div class="sayfa_buton">
            <a href="javascrip:void(0)" class="glyphicon glyphicon-chevron-left" id="onceki"></a>
            <a href="javascrip:void(0)" class="glyphicon glyphicon-chevron-right" id="sonraki"></a>
            <figure class="slider-figure"></figure>
        </div>
    </div>
<?php } ?>