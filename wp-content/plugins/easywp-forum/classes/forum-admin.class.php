<?php
/**
 * Created by JetBrains PhpStorm.
 * User: CN14323
 * Date: 14-11-28
 * Time: 下午6:07
 * To change this template use File | Settings | File Templates.
 */
class ForumAdmin
{
    private static $initiated = false;

    public static function init() {
        if ( ! self::$initiated ) {
            self::init_hooks();
        }
    }

    /**
     * Initializes WordPress hooks
     */
    private static function init_hooks() {
        self::$initiated = true;

        add_action( 'admin_menu', array( 'ForumAdmin', 'admin_menu' ));

        //echo "init hooks called";
    }

    public static function admin_menu() {
        // Main WPBB page
        var_dump("aaaa");
        add_object_page('Forum Module Overview', 'EasyWP Forum', 'manage_options', 'ezforum_admin', array( 'ForumAdmin', 'display_page' ));
    }

    public static function display_page() {
        if (!isset($_GET['view']))
            self::display_module_admin_page();
    }



}