<?php

class Board_Schema
{

    function __construct(){
    }

    function create_board_module_table(){
        var_dump($wpdb);
        if (!defined('BOARD_MODULE_TABLE'))
        {
            define('BOARD_MODULE_TABLE', $wpdb->prefix.'board_module');
        }

        $create_board_module_query = "CREATE TABLE ".BOARD_MODULE_TABLE." (
                    `module_id` INT UNSIGNED NOT NULL,
                    `module` INT UNSIGNED NOT NULL,
                    `browser_title` VARCHAR(300),
                    `list_count` INT,
                    `page_count` INT,
                    `sort_target` VARCHAR(20),
                    `sort_type` VARCHAR(5),
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";

        //var_dump($create_board_module_query);
    }

}
