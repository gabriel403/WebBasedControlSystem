<?php

/**
 * Description of SessionModel
 *
 * @author gabriel
 */
class Models_SessionModel {

    public function checksession() {
        var_dump("DOOOOOOOM");
        exit;
        if( array_key_exists("wbcsauth", $_COOKIE) && $_COOKIE['wbcsauth'] == session_id() )
            return true;
        return false;
    }

    public function setsession() {
        if( self::checksession() )
            return false;
        return setcookie("wbcsauth", session_id(), time() + 30 * 60, "/", "", 0,
                1);
    }

    public function destroysession() {
        
    }

}

?>
