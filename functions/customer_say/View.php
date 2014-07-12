<?php
/**
 * Created by PhpStorm.
 * User: olkunmustafa
 * Date: 23.12.2013
 * Time: 16:49
 */
include_once(dirname(__FILE__) . "/Controller.php");
include_once(dirname(__FILE__) . "/Model.php");

$customer_say_path  = get_bloginfo("template_url") . "/functions/customer_say/";
define("CUSTOMER_SAY_PATH",$customer_say_path);

class View {

    private $controller,$mailaddress="",$namesurname="",$messagge="";
    public static $nonce_field_action    = "wp_none_action_ms";
    public static $nonce_filed_name      = "wp_nonce_name_ms";
    const CUSTOMER_SAY_MAIL_ADDRESS      = "customer_say_mail_address";
    const CUSTOMER_SAY_NAME_SURNAME      = "customer_say_name_surname";
    const CUSTOMER_SAY_MESSAGGE          = "customer_say_messagge";
    const CUSTOMER_SAY_DATE_TIME         = "customer_say_date_time";


    function __construct(Controller $controller)
    {
        $this->controller   = $controller;
        add_action("admin_menu",array(&$this,"customer_say_admin_menu"));
        add_action("wp_print_scripts",array(&$this,"customer_say_add_style_and_js_files"));
    }

    private function customer_say_admin_menu_defaults(){
        $customer_say_admin_defaults = array(
            "page_title"        => "Sizden Gelenler",
            "menu_title"        => "Sizden Gelenler",
            "capability"        => "read",
            "menu_slug"         => "customer-say",
            "callable"          => array(&$this,"customer_say_admin_settings")
        );
        return $customer_say_admin_defaults;
    }

    public function  customer_say_admin_menu(){
        $get_customer_say_admin_defaults = $this->customer_say_admin_menu_defaults();
        add_theme_page(
            $get_customer_say_admin_defaults["page_title"],
            $get_customer_say_admin_defaults["menu_title"],
            $get_customer_say_admin_defaults["capability"],
            $get_customer_say_admin_defaults["menu_slug"],
            $get_customer_say_admin_defaults["callable"]
        );
    }

    public function customer_say_add_style_and_js_files(){
        wp_register_style("customer_say_css",CUSTOMER_SAY_PATH . "/customer_say.css");
        wp_enqueue_style("customer_say_css");
        wp_register_script("customer_say_js",CUSTOMER_SAY_PATH . "/customer_say.js");
        wp_enqueue_script("customer_say_js");
    }

    public function customer_say_admin_settings(){
        $this->controller->customer_say_admin_setting_controller();
        $get_args   = func_get_args();
        if(!empty($get_args)){
            $this->mailaddress      =   $get_args[0];
            $this->namesurname      =   $get_args[1];
            $this->messagge         =   $get_args[2];
        }
        ?>
        <form method="post" action="<?php $_SERVER['REQUEST_URI'] ?>" id="customer_say_admin_form">
            <input type="text" name="<?php echo self::CUSTOMER_SAY_MAIL_ADDRESS; ?>" value="<?php echo $this->mailaddress; ?>" placeholder="Kullanıcı Mail Adresi" />
            <input type="text" name="<?php echo self::CUSTOMER_SAY_NAME_SURNAME ?>" value="<?php echo $this->namesurname ?>" placeholder="Kuallnıcı adı soyadı" />
            <input type="hidden" name="<?php echo self::CUSTOMER_SAY_DATE_TIME; ?>" value="<?php echo date("Y-m-d H:i:s"); ?>" />
            <textarea name="<?php echo self::CUSTOMER_SAY_MESSAGGE; ?>" placeholder="Mesajınız" rows="15"><?php echo $this->messagge; ?></textarea>
            <?php wp_nonce_field(self::$nonce_field_action,self::$nonce_filed_name); ?>
            <input type="submit" value="Gönder" />
        </form>
    <?php }

    /*
     * Anasayfa da görüntüleneceği hali.
     */
    
    public function customer_say_ui(){
        $get_all_vall = $this->controller->get_all_values_in_ui();
        echo '<h4 id="customer_say_title"><a href="' . get_page_link(353) . '" title="Tamamını Gör">Sizden Gelenler</a></h4>';
        echo "<ul class='ul-left customer_say_ul' >";
        foreach($get_all_vall as $messagges){
            echo "<li>
            <article>{$messagges->customer_messagge}</article>
            <span>{$messagges->customer_name}</span>
            </li>";
        }
        echo "</ul>";
    }

    /*
     * Sayfalarda görüntülenecek ve Shortcode olarak kullanılacak.
     */
    public function customer_say_ui_page(){
        $get_all_vall = $this->controller->get_all_values_in_ui();
        echo "<ul class='ul-left customer_say_ul_page' >";
        foreach($get_all_vall as $messagges){
            echo "<li>
            <article>" . stripslashes( $messagges->customer_messagge ) ."</article>
            <span>{$messagges->customer_name}</span>
            </li>";
        }
        echo "</ul>";
    }

    private function customer_say_ui_button(){
        //TODO bu kısıma sitede buton kısmı düzenlenecek. Butona basıldığında Pop up açılacak.
    }

}