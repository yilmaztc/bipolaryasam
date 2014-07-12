<?php
    add_action( "init", "BpSliderScript" );
    function BpSliderScript()
    {
        if ( is_admin() ) return;
        wp_enqueue_script( "bp_touch_slider_script", get_template_directory_uri() . '/bp_touch_slider/bp_touch_slider.js', array( "jquery" ) );
        wp_enqueue_style( "bp_touch_slider_style", get_stylesheet_directory_uri() . "/bp_touch_slider/bp_touch_slider.css" );

    }

?>
<?php function BipolarContentSlider()
{
    ?>
    <div id="bp_content_slider">
        <ul class="bp_content_slider bp_ul_default">
            <?php

                $args = array(
                    'meta_query' => array(
                        array(
                            'key'   => 'bipo_save_post_state',
                            'value' => 1
                        )
                    )
                );
                $bipo_slider_query = new WP_Query( $args );
                if ( $bipo_slider_query->have_posts() ):
                    while ( $bipo_slider_query->have_posts() ): $bipo_slider_query->the_post();
                        ?>
                        <li>
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <?php thimtumb_rev( 750, 422 ); ?>
                            </a>
                            <article class="slider_title">
                                <h4><?php the_title(); ?></h4>
                            </article>
                        </li>
                    <?php
                    endwhile;
                endif;
            ?>

        </ul>
        <div class="bipolar_rl_button">
            <a href="javascrip:void(0)" class="glyphicon glyphicon-chevron-left" id="previous_cs"></a>
            <a href="javascrip:void(0)" class="glyphicon glyphicon-chevron-right" id="after_cs"></a>
            <figure id="slider_figure"></figure>
        </div>
    </div>
<?php } ?>
<?php

    add_action( "add_meta_boxes", "BipoSliderAddMetaboxes" );
    add_action( "save_post", "BipoSliderSavePost" );
    function BipoSliderAddMetaboxes()
    {
        add_meta_box(
            "bipo_slider_id", // Admin panelde görünen formumumuzun HTML id değeri.
            "Please Choose, This post must viewed in slider or not", // Admin panelde görünen formun kullanıcı tarafından görünen başlığı
            "callback_BipolarSlider", // Geriçağırım fonksiyonu. Gerekli değerler buraya yazılacak.
            "post", // <span style="color: #262626;">Bu kısım sadece yazılarda veya sayfalarda görülmesi için kullanılır. Her ikisinde de görülmesi için döngü kullanılmalıdır</span>.
            "normal", // Sayfanın neresinde duracağını belirtir. Sağ veya aşağı gibi. Deneyerek test edebilirsiniz.
            "high" // Bu kısımda öncelik oluyor. Verdiğiniz değere göre üstte veya altta duruyor.
        );
    }

;
    function callback_BipolarSlider()
    {
        global $post;
        $checked              = null;
        $get_bipo_information = get_post_meta( $post->ID, "bipo_save_post_state" );
        if ( !empty( $get_bipo_information ) ):
            $checked = ( $get_bipo_information[0] ) ? "checked" : "";

        endif;
        ?>
        <fieldset>
            <label for="bipo_checkbox_id">Choose the checkbox if you want that post viewed slider</label>
            <input id="bipo_checkbox_id" type="checkbox" name="bipo_checkbox_id" <?php echo " " . $checked; ?> />
        </fieldset>
    <?php } ?>
<?php
    function BipoSliderSavePost()
    {
        global $post;
        if ( isset( $_POST["bipo_checkbox_id"] ) ):
            update_post_meta( $post->ID, "bipo_save_post_state", 1 );

        else :
            update_post_meta( $post->ID, "bipo_save_post_state", 0 );

        endif;
    }

?>