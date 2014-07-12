<?php
    add_action("init","BpSliderScript");
    function BpSliderScript(){
        wp_enqueue_script( "bp_touch_slider_script", get_template_directory_uri() . '/bp_touch_slider/bp_touch_slider.js', array("jquery") );
        wp_enqueue_style( "bp_touch_slider_style", get_stylesheet_directory_uri() . "/bp_touch_slider/bp_touch_slider.css" );

    }
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
                            <img src="<?php echo GetTimthumPath(get_stylesheet_directory_uri()."/inc/img/slider_auto_image.jpg",750,422,1); ?> alt=""/>
                        </a>
                        <article class="slider_title">
                            <h4>Örnek Haber Başlığı <?php echo $i ?></h4>
                        </article>
                    </li>
                <?php
                }
            ?>
        </ul>
        <div class="bipolar_rl_button">
            <a href="javascrip:void(0)" class="glyphicon glyphicon-chevron-left" id="previous_cs"></a>
            <a href="javascrip:void(0)" class="glyphicon glyphicon-chevron-right" id="after_cs"></a>
            <figure id="slider_figure"></figure>
        </div>
    </div>
<?php } ?>