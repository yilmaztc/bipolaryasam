<?php

add_action("init", "AddAllDefaultScripts");

function AddAllDefaultScripts() {
    if (is_admin())
        return;
    //Default style dosyasını ekler.
    wp_register_style("stylesheet", get_stylesheet_uri());
    wp_enqueue_style("stylesheet");
    // Bootstrap dosyasını ekler.
    wp_enqueue_style("bootstrap", get_stylesheet_directory_uri() . "/inc/bootstrap/css/bootstrap.min.css");
    // Font Dosyasını ekler.
    wp_enqueue_style("googlefont", "http://fonts.googleapis.com/css?family=Open+Sans:400,700&subset=latin,latin-ext");
}

?>
