<?php

if(!defined('__EASYWP_BOARD__'))
{
    exit();
}

function board_create_db_table()
{
    include_board_schema();
    $boardSchema = new Board_Schema();

    $boardSchema->create_board_module_table();
}

function board_drop_db_table()
{
    var_Dump("drop_db_table");
}

function include_board_schema(){
    require_once(_BOARD_PATH_."/schemas/board-schema.php");

}