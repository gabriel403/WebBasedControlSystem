<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usertable
 *
 * @author gabriel
 */
class Models_Usertable extends Autonomic_Dbtable {

	//put your code here
	function __construct() {
		$this->setTable("user");
		$this->connect();
	}

	function nodupes() {
		
	}

	function getemail($username = false) {
		if ( !$username && array_key_exists("logged_user_name", $_SESSION) )
			$username = $_SESSION['logged_user_name'];
		else
			throw new Exception("wtf, you're not logged in");

		return $this->select(array('username', $username), "email");
	}

	function getphone($username = false) {
		if ( !$username && array_key_exists("logged_user_name", $_SESSION) )
			$username = $_SESSION['logged_user_name'];
		else
			throw new Exception("wtf, you're not logged in");

		return $this->select(array('username', $username), "phonenumber");
	}

	function auth($username, $password) {
		
		$wheres[] = array('username', $username);
		$wheres[] = array('password', $password);
		return $this->select($wheres);
	}
	
}

?>
