<?php
class ForumContext
{

    function __construct(){
    }

    public static function log( $forum_debug ) {
        if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG )
            error_log( print_r( compact( 'forum_debug' ), 1 ) ); //send message to debug.log when in debug mode
    }

    public function aaaa(){

    }

}

