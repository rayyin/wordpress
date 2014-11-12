<?php

class Easybd_Schema
{
    private $easybd_wpdb = NULL;

    public function __construct(){
        global $wpdb;
        $this->easybd_wpdb = $wpdb;
        $this->define_schemas();
    }

    private function define_schemas(){
        if (!defined('BOARD_MODULE_TABLE'))
            define('BOARD_MODULE_TABLE', $this->easybd_wpdb->prefix.'easybd_modules');
    }

    private function create_board_module_table(){
        $create_board_module_query = "CREATE TABLE ".BOARD_MODULE_TABLE." (
                    `module_id` INT UNSIGNED NOT NULL,
                    `skin` VARCHAR(250),
                    `use_mobile` CHAR(1),
                    `mlayout_id` INT,
                    `mskin` VARCHAR(250),
                    PRIMARY KEY  (`module_id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";

        $this->create_table_by_query($create_board_module_query,BOARD_MODULE_TABLE);
    }

    private function create_table_by_query($query, $table){
        $create_table = $this->easybd_wpdb->query($query);

        if ($create_table === false)
        {
            $create_table_err = _e('There was an error creating the table '.$table, __MODULE_NAME__);
            Easybd_Context::log($create_table_err);
        }
    }

    private function drop_table_by_name($table){
        $query = "DROP TABLE IF EXISTS ".$table;
        $drop_table = $this->easybd_wpdb->query($query);

        if ($drop_table === false)
        {
            $drop_table_err = _e('There was an error dropping the table '.$table, __MODULE_NAME__);
            Easybd_Context::log($drop_table_err);
        }
    }

    public function create_module_tables(){
        $this->create_board_module_table();
    }

    public function drop_module_tables(){
        $this->drop_table_by_name(BOARD_MODULE_TABLE);
    }

}
