<?php
include_once(dirname(__FILE__) . "/View.php");

$model          = new Model();
$controller     = new Controller($model);
$view           = new View($controller);


/*
 * Daha önce serkanoral.com sitesinde kullandığımız yapıda bir arayüz gösterir.
 */
function get_customer_messagges(){
    global $view;
    $view->customer_say_ui();
}

/*
 * Bu standart yapıda sizden gelenler kullanmayacağımız zaman kullanılır.
 * Burada sadece controller dosyasından gelen veriler çekilir.
 * Burdan istediğimiz yapı kullanılır.
 */
function get_customer_messagge_in_db(){
    global $controller;
    return $controller->get_all_values_in_ui();
}


/*
 * Shortcode ekledikten sonra sayfada görünmesi gerekn fonksiyon.
 */
function get_customer_messagges_page(){
    global $view;
    $view->customer_say_ui_page();
}
add_shortcode("customer-say","get_customer_messagges_page");

?>