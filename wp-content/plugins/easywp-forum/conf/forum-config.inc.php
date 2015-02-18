<?php
/**
 * set the environment configurations and other common classes
 * @file   conf/forum-config.inc.php
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

if(!defined('__EASYWP_FORUM__'))
{
    exit();
}

// define forum plugin directory
if (!defined('FORUM__PLUGIN_URL'))
{
    define('FORUM__PLUGIN_URL', substr(plugin_dir_path(__FILE__),0,strlen(plugin_dir_path(__FILE__))-5));
}

// include required class and schema files
require_once(FORUM__PLUGIN_URL."classes/forum.class.php");
require_once(FORUM__PLUGIN_URL."classes/forum-schema.class.php");
require_once(FORUM__PLUGIN_URL.'classes/forum-context.class.php');
require_once(FORUM__PLUGIN_URL.'conf/forum-func.inc.php');

