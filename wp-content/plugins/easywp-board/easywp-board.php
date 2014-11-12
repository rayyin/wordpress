<?php

/*
	Plugin Name: EasyWP Board
	Plugin URI: https://github.com/rayyin/wordpress
	Description: EasyWP board module
	Version: 1.0.0
	Author: Ray Yin
	Author URI: https://github.com/rayyin
	License: GPLv2 or later
*/

/**
 * @brief Declare constants for generic use and for checking to avoid a direct call from the Web
 **/
define('__EASYWP_BOARD__',   TRUE);
define('__MODULE_NAME__',   "easywp-board");

/**
 *	@brief Include the necessary configuration file
 **/
require_once("conf/easybd-config.inc.php");

/**
 *	@brief Hooks
 **/
register_activation_hook(__FILE__, 'easybd_activate');
register_deactivation_hook(__FILE__, 'easybd_deactivate');
register_uninstall_hook(__FILE__, 'easybd_uninstall');

/**
 * @brief Runs when plugin is activated
 **/
if (!function_exists('easybd_activate'))
{
    function easybd_activate()
    {
        create_db_tables();
    }
}

/**
 *	@brief  Runs when a plugin is deactivated
 **/
if (!function_exists('easybd_deactivate'))
{
    function easybd_deactivate()
    {
        drop_db_tables();
    }
}

/**
 *	@brief  Runs when a plugin is deleted, not deactivated
 **/
if (!function_exists('easybd_uninstall'))
{
    function easybd_uninstall()
    {
        drop_db_tables();
    }
}



