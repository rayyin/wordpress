<?php

if(!defined('__EASYWP_BOARD__'))
{
    exit();
}

function create_db_tables()
{
    $ebd_schema = Easybd_Schema::getInstance();
    $ebd_schema->create_module_init_tables();
}

function drop_db_tables()
{
    $ebd_schema = Easybd_Schema::getInstance();
    $ebd_schema->drop_module_tables();
}

function check_schma_updates()
{
    $ebd_schema = Easybd_Schema::getInstance();
}