<?php

/**
 * Description of RegistrationModel
 *
 * @author gabriel
 */
class Models_AuthModel {

	//put your code here

	public function registerValidation($name, $email, $username, $phonenumber,
		$password1, $password2) {
		$error = array();

		$name = filter_var($name, FILTER_SANITIZE_STRING,
			FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		if ( strlen($name) < 6 || strlen($name) > 64 )
			$error['name'] = "Name not of correct length. (min 6 chars)";
		else
			$error['name'] = 0;

		$email = stripslashes($email);
		$email = filter_var($email, FILTER_VALIDATE_EMAIL);
		if ( strlen($email) < 6 || strlen($email) > 64 )
			$error['email'] = "email address not validated or not of the correct length. (min 6 chars)";
		else
			$error['email'] = 0;

		$username = filter_var($username, FILTER_SANITIZE_STRING,
			FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		if ( strlen($username) < 6 || strlen($username) > 64 )
			$error['username'] = "Username not valid or not of correct length. (min 6 chars)";
		else
			$error['username'] = 0;

		$phonenumber = filter_var($phonenumber, FILTER_SANITIZE_STRING,
			FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		if ( strlen($phonenumber) < 6 || strlen($phonenumber) > 16 || !is_numeric($phonenumber) )
			$error['phonenumber'] = "Phonenumber not valid or not of correct length. (min 6 chars)";
		else
			$error['phonenumber'] = 0;

		$password1 = filter_var($password1, FILTER_SANITIZE_STRING,
			FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		if ( strlen($password1) < 6 || strlen($password1) > 32 )
			$error['password1'] = "Password not of correct length. (min 6 chars)";
		else
			$error['password1'] = 0;

		$password2 = filter_var($password2, FILTER_SANITIZE_STRING,
			FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
		if ( strlen($password2) < 6 || strlen($password2) > 32 )
			$error['password2'] = "Password not of correct length. (min 6 chars)";
		else
			$error['password2'] = 0;

		if ( count(array_count_values($error)) != 1 || !array_key_exists(0,
				array_count_values($error)) )
			return $error;

		if ( strcasecmp($password1, $password2) ) {
			$error['password1'] = "Passwords do not match!";
			$error['password2'] = "Passwords do not match!";
		}

		if ( count(array_count_values($error)) != 1 || !array_key_exists(0,
				array_count_values($error)) )
			return $error;
// TODO: check for duplicates already in the db		
		$db = new Models_Usertable();
		
		$config = Autonomic_Bootstrap::getConfig();

		$keyVals = array();
		$keyVals['name'] = $name;
		$keyVals['email'] = $email;
		$keyVals['username'] = $username;
		$keyVals['password'] = hash( 'whirlpool', $config['database']['salt'].$password1);
		$keyVals['phonenumber'] = $phonenumber;


		try {
			$insert = $db->insert($keyVals);
		} catch ( Exception $e ) {
			return array("error" => "A wild erroneous occured.");
		}
		if ( !$insert )
			return array("error" => "A wild erroneouses occured.");

		Models_SessionModel::setsession();
		$_SESSION['logged_user_name'] = $username;
		$_SESSION['last_access'] = time();
		return array("success" => "Successfully registered!", "redirect" => "/" . ROOT_URI);
	}

	public function loginValidation($username, $password) {

		$error = array();

		$username = filter_var($username, FILTER_SANITIZE_STRING);
		if ( strlen($username) < 6 || strlen($username) > 64 )
			$error['username'] = "Username not valid or not of correct length. (min 6 chars)";
		else
			$error['username'] = 0;

		$password = filter_var($password, FILTER_SANITIZE_STRING);
		if ( strlen($password) < 6 || strlen($password) > 32 )
			$error['password'] = "Password not of correct length. (min 6 chars)";
		else
			$error['password'] = 0;

		if ( count(array_count_values($error)) != 1 || !array_key_exists(0,
				array_count_values($error)) )
			return $error;

		$users = new Models_Usertable();
		$select = $users->auth($username, $password);
		if ( count($select) == 0 ) {
			$error['username'] = "Username or password do not match stored details.";
			$error['password'] = "Username or password do not match stored details.";
			return $error;
		}

		Models_SessionModel::setsession();
		$_SESSION['logged_user_name'] = $username;
		$_SESSION['last_access'] = time();
		return array("success" => "Successfully logged in!", "redirect" => "/" . ROOT_URI);
	}

}

?>
