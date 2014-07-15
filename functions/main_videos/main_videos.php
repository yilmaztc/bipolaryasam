<?php
include_once __DIR__ . "/videos_panel.php";
include_once __DIR__ . "/MainVideosWidget.php";

function ms_main_videos( $videos_title, $videos_choose ) {
    $videos_widget_class = new MainVideosWidget();
    $videos_widget_class->ms_main_videos( $videos_title, $videos_choose );
}
?>