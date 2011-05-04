<?php

/**
 * Description of Soapy
 *
 * @author gabriel
 */
class Controllers_Soapy extends Autonomic_Controller {

	function IndexAction() {
		$dbtable = new Autonomic_Dbtable();
		$dbtable->setTable("soapy");
		$dbtable->connect();

		$user = new Models_Usertable();
		$users = $user->select();
		$users2 = array();
		foreach ( $users as $value ) {
			$users2[$value['phonenumber']] = $value;
		}
		$phonenumber = $user->getphone();
		$phonenumber = $phonenumber[0]['phonenumber'];


		$messages = Models_Soap::fetch();
		$refinedMsg = Models_Soap::parseMsg($messages);
		$processed = $dbtable->select();
		$postprocessed = array();
		foreach ( $processed as $value ) {
			$postprocessed[$value["ident"]] = 1;
		}
		//var_dump($postprocessed);
		//$refinedMsg = Models_Soap::restrictToUser($refinedMsg, $phonenumber);
		$this->_getView()->messages = $refinedMsg;
		$this->_getView()->users = $users2;
		$this->_getView()->processed = $postprocessed;
		foreach ( $refinedMsg as $msg ) {
			$xml = simplexml_load_string($msg);
			$dbtable->insert(array("ident" => (string) $xml->receivedtime, "soapmsg" => $msg));
		}
//		echo Models_Soap::sendMsg("<origin>P07224405</origin><msg>s1:0:s2:1:s3:1:s4:0:ht:1:mt:-1:tp:24.30:</msg>");
	}

	function EmailAction() {
		Models_SessionModel::checksession();

		if ( !Autonomic_Helpers_IsXHR::IsXHR() )
			return;
		if ( !array_key_exists("data", $_POST) )
			return;
		
		$data = $_POST['data'];
		
		$user = new Models_Usertable();
		$email = $user->getemail();
		$email_address = $email[0]['email'];
		
		$email_subject = "Testing PHP email";
		$message = $data;
		$from_address = "From: me@example.com";
		$envelope_from_address = "me@example.com";
		$email_result = mail(
			$email_address, $email_subject, $message, $from_address,
			"-f $envelope_from_address"
		);
		echo json_encode($email_result);
		exit;
	}

	function SoapyupdateAction() {
		if ( !Autonomic_Helpers_IsXHR::IsXHR() )
			header ( "Locatin: /p07224405/index.php/soapy/");
		
		$dbtable = new Autonomic_Dbtable();
		$dbtable->setTable("soapy");
		$dbtable->connect();
		$processed = $dbtable->select();

		$messages = Models_Soap::fetch();
		$refinedMsg = Models_Soap::parseMsg($messages);
		
		$new = array();
		$new = Models_Soap::removeDupes($processed, $refinedMsg);
		$viewray = Models_Soap::viewify($new);
		var_dump($new);
		exit;
		
		
	}
	
}

?>
