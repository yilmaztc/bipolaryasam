<?php
/**
 * Created by PhpStorm.
 * User: olkunmustafa
 * Date: 23.12.2013
 * Time: 17:53
 */

abstract class CRUD {
    public abstract function insert_val();
    public abstract function get_all_vall_in_site();
    public abstract function get_spesific_all($say_id);
    public abstract function delete_val($say_id);
    public abstract function update_val($say_id);
} 