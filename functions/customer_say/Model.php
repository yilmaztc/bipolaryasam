<?php
/**
 * Created by PhpStorm.
 * User: olkunmustafa
 * Date: 23.12.2013
 * Time: 16:49
 */
include_once(__DIR__ . "/CRUD.php");

class Model extends CRUD {
    private $table_name         = "customer_say";
    private $say_id             = "say_id";
    private $customer_mail      = "customer_mail";
    private $customer_name      = "customer_name";
    private $customer_messagge  = "customer_messagge";
    private $customer_datetime  = "messagge_date_time";

    function __construct()
    {
        global $wpdb;
        $table_name     = $wpdb->prefix . $this->table_name;

        $sql = "CREATE TABLE IF NOT EXISTS {$table_name} (
        $this->say_id             int(11)   not null AUTO_INCREMENT,
        $this->customer_mail      text      not null,
        $this->customer_messagge  text      not null,
        $this->customer_name      text      not null,
        $this->customer_datetime  datetime  not null,
        PRIMARY KEY (say_id)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);
    }


    public function insert_val()
    {
        global $wpdb;
        $values     = func_get_args();
        $insert_result =    $wpdb->insert(
            $wpdb->prefix . $this->table_name,
            array(
                $this->customer_mail        => $values[0],
                $this->customer_messagge    => $values[1],
                $this->customer_name        => $values[2],
                $this->customer_datetime    => $values[3]
            )
        );
        return $insert_result;
    }

    public function get_all_vall_in_site()
    {
        global $wpdb;
        $table_name     = $wpdb->prefix . $this->table_name;
        $get_all_values_in_site     = $wpdb->get_results("select * from wp_customer_say limit 0,20");
        return $get_all_values_in_site;
    }

    public function get_spesific_all($say_id)
    {
        // TODO: Implement get_spesific_all() method.
    }

    public function delete_val($say_id)
    {
        // TODO: Implement delete_val() method.
    }

    public function update_val($say_id)
    {
        // TODO: Implement update_val() method.
    }
}