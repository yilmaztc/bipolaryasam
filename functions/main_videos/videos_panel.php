<?php
add_action('admin_menu', 'videos');
add_action("init","ms_videos_js_code");
add_action("after_setup_theme","medyasef_videos_panel");

if (function_exists('add_image_size')) {
    add_image_size('ms_main_videos_dimen', 613, 349, true); //(cropped)
}

if(!defined("MAIN_VIDEOS_COUNT")){
    define("MAIN_VIDEOS_COUNT",20);
}
if( !defined( "MAIN_VIDEOS_PATH" ) ) {
    define( "MAIN_VIDEOS_PATH",get_stylesheet_directory_uri() . "/functions/main_videos/" );
}

function medyasef_videos_panel() {
    global $wpdb;
    $table_name         = $wpdb->prefix . "ms_videos";
    $categories         = $table_name . "_categories";
    $ms_db_version      = "1.7";

    $get_ms_db_version  = get_option( "ms_videos_db_control" );

    if( empty( $get_ms_db_version ) || $get_ms_db_version != $ms_db_version ){

        $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . "(
            video_id TINYINT NOT NULL AUTO_INCREMENT ,
            video_title text NOT NULL,
            video_url text NOT NULL,
            video_img text NOT NULL,
            section_id TINYINT NOT NULL DEFAULT 1,
            PRIMARY KEY ( video_id )
            )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);

        $main_videos_row_number = $wpdb->get_var( "SELECT count(*) FROM wp_ms_videos" );
        if( MAIN_VIDEOS_COUNT >= $main_videos_row_number ) {
            $for_loop_count     = MAIN_VIDEOS_COUNT - $main_videos_row_number;
            for($i = 0; $i < $for_loop_count ; $i++):

                $wpdb->insert(
                    'wp_ms_videos',
                    array(
                        'video_title'   => "",
                        'video_url'     => "",
                        'video_img'     => ""
                    )
                );

            endfor;
        }

        $row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = 'wp_ms_videos' AND column_name = 'section_id'"  );

        if( empty( $row ) ){
            $wpdb->query("ALTER TABLE wp_ms_videos ADD section_id TINYINT NOT NULL DEFAULT 1");
        }

        $wpdb->query("ALTER TABLE wp_ms_videos CHANGE video_id  video_id INT( 11 ) NOT NULL AUTO_INCREMENT");

        $sql_new_table  = "CREATE TABLE IF NOT EXISTS " . $categories . " (
        video_cat_id TINYINT NOT NULL AUTO_INCREMENT,
        video_cat_name TINYTEXT NOT NULL,
        vide_cat_add_date DATE NOT NULL DEFAULT '0000-00-00',
        PRIMARY KEY ( video_cat_id )
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta( $sql_new_table );

        $main_videos_cat_number = $wpdb->get_var( "SELECT count(*) FROM " . $categories );
        if( $main_videos_cat_number == 0 ) {

            $wpdb->insert(
                $categories,
                array(
                    'video_cat_id'          => "",
                    'video_cat_name'        => "Genel Videolar",
                    'vide_cat_add_date'     => date("Y-m-d")
                )
            );

        }

        update_option( "ms_videos_db_control",$ms_db_version );

    }
}

function videos(){
    add_theme_page('Videoları Buraya Koyunuz', 'Videolar', 'read', 'video_adresleri', 'add_video');
}
function ms_videos_js_code(){
    wp_register_script( 'ms_videos_js_code', MAIN_VIDEOS_PATH . "main_videos.js", array("jquery") );
    wp_enqueue_script("ms_videos_js_code");

    wp_register_script( 'ms_videos_js_upload', MAIN_VIDEOS_PATH . "/main_videos_uploader.js", array('jquery','media-upload','thickbox') );
    wp_enqueue_script("ms_videos_js_upload");

    wp_enqueue_style("ms_videos_css_code",MAIN_VIDEOS_PATH . "/main_videos.css");

    wp_register_style( "icomoon", MAIN_VIDEOS_PATH . "icomoon/style.css" );
    wp_enqueue_style( "icomoon" );

    wp_enqueue_script('jquery');

    wp_enqueue_script('thickbox');
    wp_enqueue_style('thickbox');

    wp_enqueue_script('media-upload');
    wp_enqueue_script('wptuts-upload');
}
function add_video(){
    video_category_settings();

} ?>
<?php function add_new_category(){
    global $wpdb;

    if( isset( $_POST["add_new_category_name"] ) ){
        if( wp_verify_nonce( $_POST["add_new_category_name"], "add_new_category_action" ) ){
            $get_new_cat_name   = xss_security( $_POST["add_new_category"] );
            $get_insert_state      = 0;
            if( !empty( $get_new_cat_name ) ){
                $get_insert_state  = $wpdb->insert(
                    'wp_ms_videos_categories',
                    array(
                        "video_cat_id"          => "",
                        "video_cat_name"        => $get_new_cat_name,
                        "vide_cat_add_date"     => date("Y-m-d")

                    )
                );

                if( $get_insert_state ){
                    $get_insert_id   = $wpdb->insert_id;
                    for($i = 0; $i < MAIN_VIDEOS_COUNT ; $i++):

                        $wpdb->insert(
                            'wp_ms_videos',
                            array(
                                'video_title'   => "",
                                'video_url'     => "",
                                'video_img'     => "",
                                'section_id'    => $get_insert_id
                            )
                        );

                    endfor;
                }
            }

        }
    }

    ?>

    <div id="add_new_category">
        <h2 id="ms_videos_title">Alt Kısımda ki formdan yeni video kategorisi ekleyiniz.</h2>
        <form method="post" id="add_new_category_form">
            <fieldset>
                <label for="add_new_category_area">Ekleyeceğiniz yeni kategori ismini giriniz.</label>
                <input type="text" name="add_new_category" id="add_new_category_area" placeholder="Ekleyeceğiniz yeni kategori ismi" />
                <input type="submit" value="Kaydet" id="add_new_category_submit" />
            </fieldset>
            <?php wp_nonce_field("add_new_category_action","add_new_category_name"); ?>
        </form>
    </div>

<?php } ?>
<?php function video_category_settings(){
    global $wpdb;

    if( !isset( $_GET["category_id"] ) ):
        add_new_category();
        $get_category_list      = $wpdb->get_results( "select video_cat_id,video_cat_name from wp_ms_videos_categories" );
        ?>

        <table id="category_list_table">
            <?php foreach ( $get_category_list as $category ): ?>
                <?php
                $href  = $_SERVER["REQUEST_URI"] . "&category_id=" . $category->video_cat_id;
                ?>
                <tr>
                    <td width="20" class="td_one">
                        <?php echo $category->video_cat_id ;?>
                    </td>
                    <td>
                        <?php echo "<a href='" . $href . "'>" . $category->video_cat_name . "</a>"; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php
    else :
        $get_category_number    = $_GET["category_id"];

        if(isset( $_POST["main_videos_name"] )){
            if( wp_verify_nonce(  $_POST["main_videos_name"] ,"main_videos_action" ) ) {

                $ms_videos_title        = $_POST["ms_videos_title"];
                $ms_videos_url          = $_POST["ms_video_url"];
                $ms_videos_img          = $_POST["ms_video_img"];
                $ms_videos_id           = $_POST["ms_video_id"];

                for($i = 0; $i < MAIN_VIDEOS_COUNT ; $i++):
                    $wpdb->update(
                        'wp_ms_videos',
                        array(
                            'video_title'       => $ms_videos_title[$i],
                            'video_url'         => $ms_videos_url[$i],
                            'video_img'         => $ms_videos_img[$i]
                        ),
                        array( 'video_id' => $ms_videos_id[$i] )
                    );
                endfor;
            }
        }
        $get_title = $wpdb->get_row("SELECT * FROM wp_ms_videos_categories WHERE video_cat_id = " . $get_category_number);
        /*
         * Veritabanına kayıtlı tüm videolar çeker.
         */
        $get_videos_list        = $wpdb->get_results( "select * from wp_ms_videos where section_id = " . $get_category_number );
        ?>
        <h2 id="ms_videos_title"><?php echo $get_title->video_cat_name; ?></h2>
        <h3>Bu alanı Sayfa içerisine eklemek için : <span id="shortcode_about">[ms_videos_shortcode id=<?php echo $get_category_number ?>]</span></h3>
        <form id="ms_videos_panel" method="post">
            <fieldset>
                <input type="submit" value="Gönder" class="ms_videos_send_button" />
            </fieldset>
            <?php foreach( $get_videos_list as $values ): ?>
                <fieldset>
                    <label>Video <?php echo $values->video_id ?></label>

                    <label>
                        <span>Video Başlığı(Konusu)</span>
                        <input type="text" name="ms_videos_title[]" value='<?php echo $values->video_title; ?>' class="videos_text" />
                    </label>

                    <label>
                        <span>Youtube URL si</span>
                        <input type="text" name="ms_video_url[]" value="<?php echo $values->video_url; ?>" class="videos_text" />
                    </label>

                    <label>
                        <span>Video Resim ID Numarası(Link değil)</span>
                        <input type="text" name="ms_video_img[]" value="<?php echo $values->video_img; ?>" class="videos_text" id="videos_img_<?php echo $values->video_id; ?>" />
                        <input type="button" value="Upload" class="videos_upload" onclick="main_videos_uploader( 'videos_img_<?php echo $values->video_id; ?>' )" />
                    </label>
                    <input type="hidden" name="ms_video_id[]" value="<?php echo $values->video_id; ?>" />

                </fieldset>
            <?php endforeach; ?>
            <?php wp_nonce_field("main_videos_action","main_videos_name"); ?>
            <fieldset>
                <input type="submit" value="Gönder" class="ms_videos_send_button" />
            </fieldset>
        </form>
    <?php endif; ?>
<?php } ?>
<?php

function xss_security( $value ){

    return htmlspecialchars( trim( $value ) );
}

?>