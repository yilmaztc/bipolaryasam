<?php
wp_enqueue_script('slider', get_template_directory_uri() . '/inc/slider/slider.js');
wp_enqueue_style("slider", get_stylesheet_directory_uri() . "/inc/slider/style.css");
?>
<div id="slider">
    <ul class="slider">
        <?php
        for ($i = 1; $i <= 6; $i++) {
            ?>
            <li>
                <a href="#">
                    <img src="<?php echo get_stylesheet_directory_uri()?>/inc/img/slider.jpg" alt=""/>
                </a>
            </li>
            <?php
        }
        ?>
    </ul>
    <div class="sayfa_buton">
        <a href="#" class="glyphicon glyphicon-chevron-left" id="onceki"></a>
        <a href="#" class="glyphicon glyphicon-chevron-right" id="sonraki"></a>
        <figure class="slider-figure"></figure>
    </div>
</div>