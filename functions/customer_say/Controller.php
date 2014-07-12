<?php
/**
 * Created by PhpStorm.
 * User: olkunmustafa
 * Date: 23.12.2013
 * Time: 16:49
 */

class Controller {
    private $model;

    function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get_all_values_in_ui(){
        return $this->model->get_all_vall_in_site();
    }

    public function customer_say_admin_setting_controller(){
        if(isset($_POST[View::$nonce_filed_name])){
            if(wp_verify_nonce($_POST[View::$nonce_filed_name],View::$nonce_field_action)){
                $mail_address   = $this->security_form($_POST[View::CUSTOMER_SAY_MAIL_ADDRESS]);
                $name_surname   = $this->security_form($_POST[View::CUSTOMER_SAY_NAME_SURNAME]);
                $customer_msg   = $this->security_form($_POST[View::CUSTOMER_SAY_MESSAGGE]);
                $date_time      = $this->security_form($_POST[View::CUSTOMER_SAY_DATE_TIME]);

                if($mail_address != "" && $name_surname != "" && $customer_msg != "") {
                    if($this->model->insert_val($mail_address,$customer_msg,$name_surname,$date_time)){
                        echo "Başarıyla kayıt yapıldı";
                    }
                    else {
                        echo "Kayıtta sorun çıktı";
                    }
                }
                else {
                    echo "Değerler Boş Olamaz";
                }
            }
        }
    }

    private function security_form($val){
        return trim(htmlspecialchars($val));
    }

}