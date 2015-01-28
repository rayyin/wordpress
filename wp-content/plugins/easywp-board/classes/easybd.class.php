<?php
/**
 * Created by JetBrains PhpStorm.
 * User: CN14323
 * Date: 14-11-28
 * Time: 下午6:07
 * To change this template use File | Settings | File Templates.
 */
class Easybd
{
    public $ebd_schema;

    function __construct(){
    }

    public function init() {
        $ebd_schema = Easybd_Schema::getInstance();
        $this->test();
        var_dump($ebd_schema);
        exit;
    }

    function test() {
        $this->ebd_schema = null;
    }

    public function activate_module() {
        create_db_tables();
    }


}