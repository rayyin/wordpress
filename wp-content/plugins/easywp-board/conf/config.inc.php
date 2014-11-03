<?php
/**
 * set the environment configurations and other common classes
 *
 * @file   conf/config.inc.php
 * @author Ray Yin (ryin005@gmail.com)
 */
if(version_compare(PHP_VERSION, '5.4.0', '<'))
{
    @error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
}
else
{
    @error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_STRICT);
}

if(!defined('__EASY_BOARD__'))
{
    exit();
}

global $wpdb;

// Define easy-board plugin directory
if (!defined('BOARD_PATH'))
{
    define('BOARD_PATH', substr(plugin_dir_path(__FILE__),0,strlen(plugin_dir_path(__FILE__))-5));
}

// Include required class and schema files
require_once(BOARD_PATH.'conf/func.inc.php');

