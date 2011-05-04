<?php

/**
 * Description of Registration
 *
 * @author gabriel
 */
class Controllers_Auth extends Autonomic_Controller {

	public function RegistrationAction() {
		if ( strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], "xmlhttprequest") == 0 ) {
			echo new Forms_RegisterForm();
			exit;
		}
		$this->_getView()->regForm = new Forms_RegisterForm();
	}

	public function RegisterAction() {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$phonenumber = $_POST['phonenumber'];
		$password1 = $_POST['password1'];
		$password2 = $_POST['password2'];
		$register = Models_AuthModel::registerValidation($name, $email, $username,
				$phonenumber, $password1, $password2);
		if ( array_key_exists("success", $register) )
			Models_SessionModel::setsession();
		echo json_encode($register);
		exit;
	}

	public function SigniningAction() {
		if ( strcasecmp($_SERVER['HTTP_X_REQUESTED_WITH'], "xmlhttprequest") == 0 ) {
			echo new Forms_SigninForm();
			exit;
		}
		$this->_getView()->regForm = new Forms_SigninForm();
	}

	public function signinAction() {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$login = Models_AuthModel::loginValidation($username, $password);
		echo json_encode($login);
		exit;
	}

	public function LogoutAction() {
		Models_SessionModel::destroysession();
		header("Location: /p07224405");
	}

}

?>
