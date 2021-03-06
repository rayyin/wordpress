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
    private static $initiated = false;
    private static $ebd_schema = null;

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
        self::$initiated = Easybd_Schema::getInstance();;
        add_action( 'easydb_create_db_schemas', array( 'Easybd', 'create_db_schemas' ));
        add_action( 'easydb_drop_db_schemas', array( 'Easybd', 'drop_db_schemas' ));
    }

    /**
     * @brief Runs when plugin is activated
     **/
    public static function activate_module() {
        create_db_tables();
    }

    /**
     * @brief Runs when plugin is deactivated
     **/
    private static function deactivate_module() {
        drop_db_schemas();
    }

    public static function create_db_schemas() {
        self::$ebd_schema->create_module_init_tables();
    }

    public static function drop_db_schemas() {
        self::$ebd_schema->drop_module_tables();
    }


}