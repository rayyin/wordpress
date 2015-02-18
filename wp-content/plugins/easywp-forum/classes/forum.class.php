<?php
/**
 * Created by JetBrains PhpStorm.
 * User: CN14323
 * Date: 14-11-28
 * Time: 下午6:07
 * To change this template use File | Settings | File Templates.
 */
class Forum
{
    private static $initiated = false;
    private static $forum_schema = null;

    public static function init() {
        if ( ! self::$initiated ) {
            self::init_hooks();
        }

        //echo "init called";
    }

    /**
     * Initializes WordPress hooks
     */
    private static function init_hooks() {
        self::$initiated = true;
        self::$forum_schema = ForumSchema::getInstance();

        //echo "init hooks called";
    }

    /**
     * @brief Runs when plugin is activated
     **/
    public static function activate_module() {
        self::create_db_schemas();
    }

    /**
     * @brief Runs when plugin is deactivated
     **/
    public static function deactivate_module() {
        self::drop_db_schemas();
    }

    public static function create_db_schemas() {
        $schema_instance = (self::$forum_schema == null) ? ForumSchema::getInstance():self::$forum_schema;
        $schema_instance->create_module_init_tables();
    }

    public static function drop_db_schemas() {
        $schema_instance = (self::$forum_schema == null) ? ForumSchema::getInstance():self::$forum_schema;
        $schema_instance->drop_module_tables();
    }


}