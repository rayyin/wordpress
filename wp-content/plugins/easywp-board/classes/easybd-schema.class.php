<?php
class Easybd_Schema
{
    public $easybd_wpdb;
    public $module_schemas;

    public static function &getInstance()
    {
        static $theInstance = null;
        if (!$theInstance) {
            $theInstance = new Easybd_Schema();
        }

        return $theInstance;
    }

    function __construct(){
        global $wpdb;
        $this->easybd_wpdb = $wpdb;
        $this->define_schemas();
    }

    private function define_schemas(){
        $this->module_schemas = array("BOARD_MODULE_TABLE"=>$this->easybd_wpdb->prefix.'easybd_modules');
        $this->module_schemas["BOARD_FORUM_CATEGORY_TABLE"] = $this->easybd_wpdb->prefix.'easybd_forum_categories';
        $this->module_schemas["BOARD_FORUM_TABLE"] = $this->easybd_wpdb->prefix.'easybd_forums';
        $this->module_schemas["BOARD_DOCUMENT_CATEGORY_TABLE"] = $this->easybd_wpdb->prefix.'easybd_document_categories';
        $this->module_schemas["BOARD_DOCUMENT_TABLE"] = $this->easybd_wpdb->prefix.'easybd_documents';
        $this->module_schemas["BOARD_COMMENT_TABLE"] = $this->easybd_wpdb->prefix.'easybd_comments';

        foreach ($this->module_schemas as $key => $schema) {
            if (!defined($key))
                define($key, $schema);
        }
    }

    private function create_module_table(){
        $create_module_query = "CREATE TABLE ".BOARD_MODULE_TABLE." (
                    module_id BIGINT(20) UNSIGNED NOT NULL,
                    user_id BIGINT(20) UNSIGNED NOT NULL,
                    lang_code VARCHAR(10) DEFAULT 'en',
                    layout VARCHAR(250),
                    skin VARCHAR(250),
                    use_mobile CHAR(1),
                    mlayout_id INT(11),
                    mskin VARCHAR(250),
                    enable_forum_category CHAR(1) DEFAULT 'Y',
                    enable_document_category CHAR(1) DEFAULT 'Y',
                    PRIMARY KEY (module_id),
                    FOREIGN KEY (module_id) REFERENCES wp_posts(ID) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (user_id) REFERENCES wp_users(ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";
        $this->execute_query($create_module_query,BOARD_MODULE_TABLE);
    }

    public function create_forum_category_table(){
        $create_forum_category_query = "CREATE TABLE ".BOARD_FORUM_CATEGORY_TABLE." (
                    category_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    module_id BIGINT(20) UNSIGNED NOT NULL,
                    parent_category_id INT(11) UNSIGNED DEFAULT 0,
                    user_id BIGINT(20) UNSIGNED NOT NULL,
                    name VARCHAR(250) NOT NULL,
                    description VARCHAR(250),
                    forum_count INT(11) DEFAULT 0,
                    list_order INT(11) UNSIGNED NOT NULL,
                    regdate DATETIME NOT NULL,
                    last_update DATETIME NOT NULL,
                    PRIMARY KEY (category_id),
                    FOREIGN KEY (module_id) REFERENCES ".BOARD_MODULE_TABLE."(module_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (parent_category_id) REFERENCES ".BOARD_FORUM_CATEGORY_TABLE."(category_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (user_id) REFERENCES wp_users(ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";
        $this->execute_query($create_forum_category_query,BOARD_FORUM_CATEGORY_TABLE);

        //category_id INT(11) UNSIGNED DEFAULT 0,
        //FOREIGN KEY (category_id) REFERENCES ".BOARD_FORUM_CATEGORY_TABLE."(category_id) ON DELETE CASCADE ON UPDATE CASCADE,
    }

    private function create_forum_table(){
        $create_forum_query = "CREATE TABLE ".BOARD_FORUM_TABLE." (
                    forum_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    module_id BIGINT(20) UNSIGNED NOT NULL,
                    parent_forum_id INT(11) UNSIGNED DEFAULT 0,
                    user_id BIGINT(20) UNSIGNED NOT NULL,
                    name VARCHAR(250) NOT NULL,
                    description VARCHAR(250) NOT NULL,
                    document_count BIGINT(20),
                    comment_count BIGINT(20),
                    show_subforum CHAR(1) DEFAULT 'Y',
                    lang_code VARCHAR(10) DEFAULT 'en',
                    list_order INT(11) UNSIGNED NOT NULL,
                    regdate DATETIME NOT NULL,
                    last_update DATETIME NOT NULL,
                    PRIMARY KEY (forum_id),
                    FOREIGN KEY (module_id) REFERENCES ".BOARD_MODULE_TABLE."(module_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (parent_forum_id) REFERENCES ".BOARD_FORUM_TABLE."(forum_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (user_id) REFERENCES wp_users(ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";
        $this->execute_query($create_forum_query,BOARD_FORUM_TABLE);
    }

    public function create_document_category_table(){
        $create_document_category_query = "CREATE TABLE ".BOARD_DOCUMENT_CATEGORY_TABLE." (
                    category_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    module_id BIGINT(20) UNSIGNED NOT NULL,
                    parent_category_id INT(11) UNSIGNED DEFAULT 0,
                    user_id BIGINT(20) UNSIGNED NOT NULL,
                    name VARCHAR(250) NOT NULL,
                    description VARCHAR(250),
                    document_count INT(11) DEFAULT 0,
                    comment_count INT(11) DEFAULT 0,
                    list_order INT(11) UNSIGNED NOT NULL,
                    regdate DATETIME NOT NULL,
                    last_update DATETIME NOT NULL,
                    PRIMARY KEY (category_id),
                    FOREIGN KEY (module_id) REFERENCES ".BOARD_MODULE_TABLE."(module_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (parent_category_id) REFERENCES ".BOARD_DOCUMENT_CATEGORY_TABLE."(category_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (user_id) REFERENCES wp_users(ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";
        $this->execute_query($create_document_category_query,BOARD_DOCUMENT_CATEGORY_TABLE);

        //category_id INT(11) UNSIGNED DEFAULT 0,
        //FOREIGN KEY (category_id) REFERENCES ".BOARD_DOCUMENT_CATEGORY_TABLE."(category_id) ON DELETE CASCADE ON UPDATE CASCADE,
    }

    private function create_document_table(){
        $create_board_document_query = "CREATE TABLE ".BOARD_DOCUMENT_TABLE." (
                    document_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    module_id BIGINT(20) UNSIGNED NOT NULL,
                    forum_id INT(11) UNSIGNED NOT NULL,
                    is_notice CHAR(1) DEFAULT 'N',
                    title VARCHAR(250) NOT NULL,
                    content TEXT NOT NULL,
                    read_count INT(11) DEFAULT 0,
                    voted_count INT(11) DEFAULT 0,
                    blamed_count INT(11) DEFAULT 0,
                    comment_count INT(11) DEFAULT 0,
                    trackback_count INT(11) DEFAULT 0,
                    uploaded_count INT(11) DEFAULT 0,
                    user_id BIGINT(20) UNSIGNED DEFAULT 0,
                    user_name VARCHAR(80) NOT NULL,
                    display_name VARCHAR(80) NOT NULL,
                    tags TEXT DEFAULT NULL,
                    extra_vars TEXT DEFAULT NULL,
                    regdate DATETIME NOT NULL,
                    last_update DATETIME NOT NULL,
                    last_updater_id BIGINT(20) UNSIGNED DEFAULT 0,
                    last_updater_name VARCHAR(80) NOT NULL,
                    ipaddress VARCHAR(128) NOT NULL,
                    list_order INT(11) UNSIGNED NOT NULL,
                    update_order INT(11) UNSIGNED NOT NULL,
                    allow_trackback CHAR(1) DEFAULT 'Y',
                    notify_message CHAR(1) DEFAULT 'N',
                    status VARCHAR(20) DEFAULT 'PUBLIC',
                    comment_status VARCHAR(20) DEFAULT 'ALLOW',
                    PRIMARY KEY (document_id),
                    FOREIGN KEY (module_id) REFERENCES ".BOARD_MODULE_TABLE."(module_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (forum_id) REFERENCES ".BOARD_FORUM_TABLE."(forum_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (user_id) REFERENCES wp_users(ID),
                    FOREIGN KEY (last_updater_id) REFERENCES wp_users(ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";
        $this->execute_query($create_board_document_query,BOARD_DOCUMENT_TABLE);
    }

    private function create_comment_table(){
        $create_document_category_query = "CREATE TABLE ".BOARD_COMMENT_TABLE." (
                    comment_id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                    module_id BIGINT(20) UNSIGNED NOT NULL,
                    forum_id INT(11) UNSIGNED NOT NULL,
                    document_id INT(11) UNSIGNED NOT NULL,
                    parent_comment_id INT(11) UNSIGNED DEFAULT 0,
                    is_secret CHAR(1) NOT NULL DEFAULT 'N',
                    content TEXT NOT NULL,
                    voted_count INT(11) DEFAULT 0,
                    blamed_count INT(11) DEFAULT 0,
                    notify_message CHAR(1) DEFAULT 'N',
                    user_id BIGINT(20) UNSIGNED DEFAULT 0,
                    user_name VARCHAR(80) NOT NULL,
                    display_name VARCHAR(80) NOT NULL,
                    uploaded_count INT(11) DEFAULT 0,
                    regdate DATETIME NOT NULL,
                    last_update DATETIME NOT NULL,
                    ipaddress VARCHAR(128) NOT NULL,
                    list_order INT(11) UNSIGNED NOT NULL,
                    status INT(1) DEFAULT 1,
                    PRIMARY KEY (comment_id),
                    FOREIGN KEY (module_id) REFERENCES ".BOARD_MODULE_TABLE."(module_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (forum_id) REFERENCES ".BOARD_FORUM_TABLE."(forum_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (document_id) REFERENCES ".BOARD_DOCUMENT_TABLE."(document_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (parent_comment_id) REFERENCES ".BOARD_COMMENT_TABLE."(comment_id) ON DELETE CASCADE ON UPDATE CASCADE,
                    FOREIGN KEY (user_id) REFERENCES wp_users(ID)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
                ";
        $this->execute_query($create_document_category_query,BOARD_COMMENT_TABLE);
    }

    private function execute_query($query, $table){
        $create_table = $this->easybd_wpdb->query($query);

        if ($create_table === false)
        {
            $create_table_err = _e('There was an error creating the table '.$table, __MODULE_NAME__);
            Easybd_Context::log($create_table_err);
        }
    }

    private function drop_table_by_name($table){
        $query = "DROP TABLE IF EXISTS ".$table;
        $drop_table = $this->easybd_wpdb->query($query);

        if ($drop_table === false) {
            $drop_table_err = _e('There was an error dropping the table '.$table, __MODULE_NAME__);
            Easybd_Context::log($drop_table_err);
        }
    }

    public function create_module_init_tables(){
        $this->create_module_table();
        $this->create_forum_table();
        $this->create_document_table();
        $this->create_comment_table();
    }

    public function drop_module_tables(){
        // drop tables with a proper order (e.g. avoid FK constraint)
        $drop_tables = array_reverse($this->module_schemas);

        foreach ($drop_tables as $key => $table) {
            $this->drop_table_by_name($table);
        }
    }

    /*public function check(){
        $this->drop_table_by_name(BOARD_MODULE_TABLE);
    }*/


}
