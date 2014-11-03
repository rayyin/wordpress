<?php

/*
	Plugin Name: Easy Board
	Plugin URI: http://raywp.com:8064/extend/plugins/wp-bulletin-board/
	Description: An board for Wordpress
	Version: 1.0.0
	Author: Ray Yin
	Author URI: http://rayyin.com
	License: GPLv2 or later
*/

/**
 * @brief Declare constants for generic use and for checking to avoid a direct call from the Web
 **/
define('__EASY_BOARD__',   TRUE);

/**
 *	@brief Include the necessary configuration file
 **/
require_once("conf/config.inc.php");

/**
 *	@brief Hooks
 **/
register_activation_hook(__FILE__, 'board_activate');
register_uninstall_hook(__FILE__, 'board_uninstall');

/**
 * @brief Runs when plugin is activated
 **/
if (!function_exists('board_activate'))
{
    var_Dump("dddddddddd");
    function board_activate()
    {
        var_Dump("hahahahahahahh");
        board_create_db_table();
        exit();
        //board_create_db_table();
        //$template = wpab_create_template_file();
    }
}

/**
 *	@brief  Runs when a plugin is deleted, not deactivated
 **/

if (!function_exists('board_uninstall'))
{
    function board_uninstall()
    {
        var_Dump("dddddddddddddd");
        //board_create_drop_table();
    }
}



