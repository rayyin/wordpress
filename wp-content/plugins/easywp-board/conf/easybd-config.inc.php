<?php
/**
 * set the environment configurations and other common classes
 *
 * @file   conf/easybd-config.inc.php
 * @author Ray Yin (ryin005@gmail.com)
 */
/*if(version_compare(PHP_VERSION, '5.4.0', '<'))
{
    @error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
}
else
{
    @error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING ^ E_STRICT);
}*/

if(!defined('__EASYWP_BOARD__'))
{
    exit();
}

// Define easywp-board plugin directory
if (!defined('EASYBD__PLUGIN_URL'))
{
    define('EASYBD__PLUGIN_URL', substr(plugin_dir_path(__FILE__),0,strlen(plugin_dir_path(__FILE__))-5));
}

// Include required class and schema files
require_once(EASYBD__PLUGIN_URL."classes/easybd-schema.class.php");
require_once(EASYBD__PLUGIN_URL.'classes/easybd-context.class.php');
require_once(EASYBD__PLUGIN_URL.'conf/easybd-func.inc.php');

