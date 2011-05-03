<?php
/**
 * Description of Authed
 *
 * @author gabriel
 */
class Local_Authed {

	public function isAuthed() {
		Models_SessionModel::checkAndRedirect();
		if ( time() >= $_SESSION['last_access'] + (10*60) ) {
			Models_SessionModel::destroysession ( );
		}
		else
			$_SESSION['last_access'] = time();
	}

}

?>
