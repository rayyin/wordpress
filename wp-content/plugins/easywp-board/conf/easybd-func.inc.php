<?php

if(!defined('__EASYWP_BOARD__'))
{
    exit();
}

function create_db_tables()
{
    $ebd_schema = new Easybd_Schema();
    $ebd_schema->create_module_tables();
}

function drop_db_tables()
{
    $ebd_schema = new Easybd_Schema();
    $ebd_schema->drop_module_tables();
}