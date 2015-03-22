<?php

/*
	Plugin Name: EasyWP Forum
	Plugin URI: https://github.com/rayyin/wordpress
	Description: EasyWP forum module
	Version: 1.0.0
	Author: Ray Yin
	Author URI: https://github.com/rayyin
	License: GPLv2 or later
*/

/**
 * @brief Declare constants for generic use and for checking to avoid a direct call from the Web
 **/
define('__EASYWP_FORUM__',   TRUE);
define('__MODULE_NAME__',   "easywp-forum");

/**
 *	@brief Include the necessary configuration file
 **/
require_once("conf/forum-config.inc.php");
/**
 *	@brief Hooks
 **/

add_action( 'init', array( 'Forum', 'init' ));
if ( is_admin() ) {
    add_action( 'init', array( 'ForumAdmin', 'init' ) );
}

register_activation_hook( __FILE__, array( 'Forum', 'activate_module' ));
register_deactivation_hook(__FILE__, array( 'Forum', 'deactivate_module' ));


//echo "<script type=\"text/javascript\">alert(hello);</script>";
/**
 *	@brief Hooks
 **/
//register_activation_hook(__FILE__, 'easybd_activate');
//register_activation_hook( __FILE__, array( 'Easybd', 'activate_module' ));
//register_deactivation_hook(__FILE__, 'easybd_deactivate');
//register_uninstall_hook(__FILE__, 'easybd_uninstall');

/**
 *	@brief Actions
 **/
//add_action('admin_menu', 'easybd_admin_pages');

//add_action( 'admin_footer', 'check_schema_changes' );
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

/**
 *	@brief  Activate the module admin pages
 **/
if (!function_exists('easybd_admin_pages'))
{
    function easybd_admin_pages()
    {
        add_object_page('EasyWP Board Overview', 'EasyWP Forum', 'manage_options', 'easybd_admin', 'easybd_admin_display', '');
    }
}

/**
 *	@brief  Activate the module admin pages
 **/
if (!function_exists('easybd_admin_display'))
{
    function easybd_admin_display()
    {
        //wpab_register_admin_styles();
        //require_once('php/admin/wpab-admin-index.php');
    }
}

/*function check_schema_changes() {
?>
    <script type="text/javascript" >
        jQuery(document).ready(function($) {
            var data = {
                action: 'my_action',
                whatever: 1234
            };
            ajaxurl = "conf/easybd-func.inc.php"
            $.post(ajaxurl, data, function(response) {
                alert('Got this from the server: ' + response);
            });
            alert("hahhhahhha");
        });
    </script>
<?php
}*/

