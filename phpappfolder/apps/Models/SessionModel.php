<?php

/**
 * Description of SessionModel
 *
 * @author gabriel
 */
class Models_SessionModel {

	public static function checksession() {
		if ( strlen(session_id()) == 0 )
			session_start();
//		echo (int)array_key_exists(session_name(), $_COOKIE);
//		echo (int)$_COOKIE[session_name()] == session_id();
//		echo (int)array_key_exists("last_access", $_SESSION);
//		echo (int)array_key_exists("logged_user_name", $_SESSION);
		if ( array_key_exists(session_name(), $_COOKIE) && $_COOKIE[session_name()] == session_id()
			&& array_key_exists("last_access", $_SESSION)&& array_key_exists("logged_user_name", $_SESSION) )
			return true;
		return false;
	}

	public static function setsession() {
		if ( self::checksession() )
			return false;
		return setcookie(session_name(), session_id(), time() + 30 * 60, "/", "", 0, 1);
	}

	public static function destroysession() {
		$_SESSION = array();
		if ( isset($_COOKIE[session_name()]) ) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', 1, $params['path'], $params['domain'],
				$params['secure'], isset($params['httponly']));
		}
		session_regenerate_id();
		session_destroy();
	}

	public static function checkAndRedirect() {
		$ab = Autonomic_Bootstrap::getInstance();

		if ( !self::checksession() && strcasecmp($ab->method, "fourohthree") )
			header('Location: /' . ROOT_URI . 'fourohthree');
		if ( self::checksession() && strcasecmp($ab->method, "fourohthree") == 0 )
			header('Location: /' . ROOT_URI);
	}

}

?>
