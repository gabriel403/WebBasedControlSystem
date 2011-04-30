<?php

/**
 * Description of SessionModel
 *
 * @author gabriel
 */
class Models_SessionModel {

    public function checksession() {
        if( array_key_exists("wbcsauth", $_COOKIE) && $_COOKIE['wbcsauth'] == session_id() )
            return true;
        return false;
    }

    public function setsession() {
        if( self::checksession() )
            return false;
        session_start();
        return setcookie("wbcsauth", session_id(), time() + 30 * 60, "/", "", 0,
                1);
    }

    public function destroysession() {
        
    }

    public function checkAndRedirect() {
        $ab = Autonomic_Bootstrap::getInstance();
        if ( !self::checksession() && strcasecmp($ab->method,"fourohthree") )
                header( 'Location: fourohthree' ) ;
        if ( self::checksession() && strcasecmp($ab->method,"fourohthree") == 0 )
                header( 'Location: /'.ROOT_URI ) ;
    }
    
}

?>
