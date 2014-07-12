<?php
//wordpress e bir register side bar ekleyeceğimiz haber veriyoruz.
add_action( 'widgets_init', 'main_videos_widget_functions' );

//burada yukarıda add_action ile belirttiğimiz my_widget ile fonksiyonumu ekliyoruz
function main_videos_widget_functions(){
    //widgetim adında bir class ve aynı isimde bir fonksiyon olurşturacağız
    register_widget( 'MainVideosWidget' );
}

class MainVideosWidget extends WP_Widget {

    //Bu Kısım __construct
    public function MainVideosWidget() {
        add_shortcode( "ms_videos_shortcode",array( $this,"ms_videos_shortcode_func" ) );
        //bu kısımda bileşenimizi sayfamıza ekliyoruz
        $widget_ops = array( 'classname' => 'main_videos', 'description' => 'Bileşen Olarak Sayfalara Videolar Eklenmesi İçin Kullanılır.' );

        //Bu kısım  kontrol kısmı. Yani bileşeni bir widget a atadığımız zaman ki özellikleri.
        $control_ops = array( 'width' => 288, 'height' => 400, 'id_base' => 'main_videos' );

        //yukarıda belirttiğimiz özelliklerde widget ekliyoruz.
        $this->WP_Widget( 'main_videos', "Videolar Bileşeni", $widget_ops, $control_ops );
    }

    //widget adlı fonksiyon ile devam ediyoruz. Bu isim asla değişmemeli.
    //bu kısım sayfada görüneceği şekilde ayarlandı.
    public function widget( $args, $instance ) {

        //Buradaki args da wordpress ten otomatik olarka geliyor.
        extract( $args );

        $title = $instance['title'];

        echo $before_widget;

        $arrow = '<ol id="videos_arrows">
                        <li id="videos_left">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </li>
                        <li id="videos_right">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </li>
                    </ol>';

        if($title){
            echo $before_title .  $title . $arrow .  $after_title;
        }

        $this->ms_main_videos( false );

        echo $after_widget;
    }

    function form( $instance ) {

        //Bu kısım sadece admin panelde gösterilir. Defaultslarda hiç ayar yapılmazsa olacaklardır.
        $defaults = array("title" => "Videolar");
        $instance = wp_parse_args( (array) $instance, $defaults );
        echo "<input
        type='text' id='" . $this->get_field_name( 'title' )  . "'
        name='" .  $this->get_field_name( 'title' ) .  "'
        value='" . htmlspecialchars( $instance['title'] ) . "'
        style='width:100%;'
        />";
    }
    /*
     * Videoların hem bileşen, hem short_code hemde, sayfa içerisinde kullanılması için ortak fonksiyon olarak kullanılır.
     * @since   0.1
     * @param   boolean $videos_title kullanılacağı yerde, başlık görünmesi veya görünmemesi için kullanılır.
     * @param   boolean $all_view uygulama ekranında alt tarafta tüm videoların listelenip listenmeyeceği bilgisini verir.
     * @param   String  $videos_wrap_id Videolar ekranının tamamnının kaplayacak id ismidir. Bazı sitelerde bunu değiştirerek farklı CSS kodlarıyla etkinmesi için yazılmıştır.
     * @param   String  $slider_list Videoların slider şeklinde sıralandığı listenin id değerini verir.
     * @param   int     $id Database'den hangi video kategorisinin çekileceğine karar verir.
     * @return  Girilen değerlere göre tüm videoları ekrana basar.
     */
    public function ms_main_videos( $videos_title,$all_view = false, $videos_wrap_id = "videos_wrap", $slider_list = "video_list_slider", $id = 1 ){
        global $wpdb;
        ?>
        <div id="<?php echo $videos_wrap_id; ?>">
            <div id="videos_inner">
                <?php if( $videos_title ): ?>
                    <fieldset id="title_fieldset" class="bordered">
                        <h4 id="videos_title">Videolar</h4>
                        <span class="index_ucgen"></span>
                        <ol id="videos_arrows">
                            <li id="videos_left"><span class="glyphicon glyphicon-chevron-left"></span></li>
                            <li id="videos_right"><span class="glyphicon glyphicon-chevron-right"></span></li>
                        </ol>
                    </fieldset>
                <?php endif; ?>

                <ul id="<?php echo $slider_list; ?>">
                    <?php
                    $get_videos     = $wpdb->get_results( "SELECT * FROM wp_ms_videos where section_id = " . $id);
                    foreach( $get_videos as $value ){
                        if( $value->video_url != "" ){
                            $subject        = null;
                            $img_url        = null;

                            $video_explode      = explode( "=",$value->video_url );

                            if( $value->video_title == null ) {
                                $url        = "http://gdata.youtube.com/feeds/api/videos/"  . $video_explode[1];
                                $doc        = new DOMDocument;
                                $doc->load( $url );
                                $subject    = $doc->getElementsByTagName("title")->item(0)->nodeValue;
                            }
                            else {
                                $subject    = $value->video_title;
                            }

                            if( $value->video_img == null ){
                                $img_url            = "http://img.youtube.com/vi/$video_explode[1]/hqdefault.jpg";
                            }

                            else {
                                $img_url            = wp_get_attachment_image_src( $value->video_img,"ms_main_videos_dimen" );
                                $img_url            = $img_url[0];
                            }

                            ?>
                            <li>
                                <span class="video_title_class title-<?php echo $value->video_id; ?>"><?php echo $subject; ?></span>
                                <div style="background:
                                    url(<?php echo MAIN_VIDEOS_PATH; ?>/assets/youtube_play.png) no-repeat center center,
                                    url(<?php echo $img_url; ?>) no-repeat center center;
                                    background-size: 10%,100%"
                                     id="video-<?php echo $value->video_id; ?>"
                                     onclick="LoadYoutubeVidOnPreviewClick(
                                         'video-<?php echo $value->video_id; ?>',
                                         '<?php echo $video_explode[1]; ?>',
                                         'title-<?php echo $value->video_id; ?>'
                                         )"
                                    ></div>
                            </li>
                        <?php
                        }}
                    ?>
                </ul>
                <span id="view_all_videos">
                    <a href="javascript:void(0)">
                        Tüm Videoları Gör >>
                    </a>
                </span>
                <?php if( $all_view ): ?>
                    <div id="video_list_chooser_wrap">
                        <span class="video_list_chooser_span icon-arrow-left" id="chooser_left"></span>
                        <div id="chooser_wrap">
                            <ul id="video_list_chooser">
                                <?php
                                foreach( $get_videos as $value ):
                                    if( $value->video_url != "" ):
                                        $img_url        = null;
                                        $video_explode      = explode( "=",$value->video_url );

                                        if( $value->video_img == null ){
                                            $img_url            = "http://img.youtube.com/vi/$video_explode[1]/hqdefault.jpg";
                                        }

                                        else {
                                            $img_url            = wp_get_attachment_image_src( $value->video_img,"ms_main_videos_dimen" );
                                            $img_url            = $img_url[0];
                                        }

                                        ?>
                                        <li>
                                            <div style="background:
                                                url(<?php echo $img_url; ?>) no-repeat center center;
                                                background-size: 100%,100%"
                                                 id="video-<?php echo $value->video_id; ?>"></div>
                                        </li>
                                    <?php endif; endforeach; ?>
                            </ul>
                        </div>
                        <span class="video_list_chooser_span icon-uniE601" id="chooser_right"></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php }

    public function ms_videos_shortcode_func( $atts ){
        extract( shortcode_atts( array(
            'id' => 1,
        ), $atts ) );
        $this->ms_main_videos(false, false, "page_ms_wrapper", "page_ms_video_list", $id);
    }

} ?>
