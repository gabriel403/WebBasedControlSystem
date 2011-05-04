<?php
/**
 * Description of Authed
 *
 * @author gabriel
 */
class Local_Authed {

	public function isAuthed() {
		Models_SessionModel::checkAndRedirect();
		if ( array_key_exists("last_access", $_SESSION) && time() >= $_SESSION['last_access'] + (10*60) ) {
			Models_SessionModel::destroysession ( );
			header("Location: /p07224405");
		}
		else if ( array_key_exists("last_access", $_SESSION) ) {
			$_SESSION['last_access'] = time();
		}
	}

}

?>
