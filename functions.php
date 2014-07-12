<?php

    add_action( "wp_enqueue_scripts", "AddAllDefaultScripts" );

    function AddAllDefaultScripts()
    {
        if ( is_admin() )
            return;

        //Default style dosyasını ekler.
        wp_register_style( "stylesheet", get_stylesheet_uri() );
        wp_enqueue_style( "stylesheet" );
        // Bootstrap dosyasını ekler.
        wp_enqueue_style( "bootstrap", get_stylesheet_directory_uri() . "/inc/bootstrap/css/bootstrap.min.css" );
        // Font Dosyasını ekler.
        wp_enqueue_style( "googlefont", "http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext" );
        // js dosyası ekler
        wp_enqueue_script( 'sub-menu', get_template_directory_uri() . '/inc/js/menu_dropdown.js', array( "jquery" ) );
        wp_enqueue_script( 'dropdown-menu', get_template_directory_uri() . '/inc/js/header_scroll_flex.js', array( "jquery" ) );
        //Touchswipe
        wp_enqueue_script("touchswipe", "http://labs.skinkers.com/content/touchSwipe/jquery.touchSwipe.min.js",array("jquery") );
    }

    /*
     * Tema içerisinde ki timthumb dosyasının yolunu verir.
     * @return String Timthumb dosyasının tam yolu.
     */
    function GetTimthumPath( $imagepath, $width, $height, $zc )
    {

        return get_bloginfo( "template_url" ) . "/timthumb.php?src=" . $imagepath . "&w=" . $width . "&h=" . $height . "&zc=" . $zc;

    }
    require_once( __DIR__ . "/bp_touch_slider/bp_touch_slider.php" );
    include_once ( __DIR__ . "/functions/main_videos/main_videos.php" );
?>
