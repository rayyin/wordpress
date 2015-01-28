<?php
class Easybd_Context
{

    function __construct(){
    }

    public static function log( $easybd_debug ) {
        if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG )
            error_log( print_r( compact( 'easybd_debug' ), 1 ) ); //send message to debug.log when in debug mode
    }

    public function aaaa(){

    }

}

