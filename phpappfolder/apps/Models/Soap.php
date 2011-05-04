<?php

/**
 * Description of Soap
 *
 * @author gabriel
 */
class Models_Soap {

	private static $soapmodel;
	private static $soapclient;
	private static $username;
	private static $password;
	private static $deviceMSISDN;

	public static function getInstance() {
		if ( !self::$soapmodel ) {
			self::$soapmodel = new Models_Soap();
		}

		return self::$soapmodel;
	}

	function __construct() {
		$config = Autonomic_Bootstrap::getConfig();
		self::$username = $config["orangem2m"]["username"];
		self::$password = $config["orangem2m"]["password"];
		self::$deviceMSISDN = $config["orangem2m"]["deviceMSISDN"];
		self::$soapclient = new SoapClient
				("https://m2mconnect.orange.co.uk/orange-soap/services/MessageServiceByCountry?wsdl");
	}

	static function fetch() {
		self::getInstance();
		return self::$soapclient->peekMessages(self::$username, self::$password, 100,
			"", "");
	}

	static function sendMsg($msg) {
		self::getInstance();
		return self::$soapclient->sendMessage(self::$username, self::$password,
			self::$deviceMSISDN, htmlentities($msg), false, "SMS");
	}

	static function parseMsg($messages) {
		/*
		 * 
		 * messages consist of:
		 * the origin,
		 * the state of the 4 switches, 1 for on, 0 for off
		 * the state of the heater, 1 for on, 0 for off
		 * the state of the motor, 0 for off, 1 for on, -1 for reverse
		 * the current temperate 00.00
		 * origin:originphonenumber:
		 * s1:1|0:
		 * s2:1|0:
		 * s3:1|0:
		 * s4:1|0:
		 * ht:1|0:
		 * mt:-1|0|1: 
		 * tp:00.00:
		 * 
		 */
		$newray = array();
		$returnray = array();
		foreach ( $messages as $key => $message ) {
			$sxml = @simplexml_load_string(html_entity_decode($message));
			if ( !$sxml ) {
				unset($messages[$key]);
				continue;
			}
			$message = $sxml->message->msg;
			$explode = explode(":", $message);
			if ( count($explode) == 1 ) {
				unset($messages[$key]);
				continue;
			}

			$newray = array();
			for ( $i = 0; $i < count($explode); $i +=2 ) {
				if ( strlen(trim($explode[$i])) > 0 )
					$newray[$explode[$i]] = $explode[$i + 1];
			}
			//$xml = new SimpleXMLElement("<msg></msg>");
			$f = create_function('$f,$c,$a',
				' 
            foreach($a as $k=>$v) { 
                if(is_array($v)) { 
                    $ch=$c->addChild($k); 
                    $f($f,$ch,$v); 
                } else { 
                    $c->addChild($k,$v); 
                } 
            }');
			$sxml->message->msg = "";
			$f($f, $sxml->message->msg, $newray);
			//var_dump($xml);
			//$sxml->message->msg = $xml->asXML();
			//echo "<br /><br />";
			//var_dump(simplexml_load_string(html_entity_decode($sxml->message->msg)));
			$returnray[trim((string) $sxml->receivedtime)] = $sxml->asXML();
			//exit;
		}

		//var_dump($messages);
		return $returnray;
	}

	static function restrictToUser($messages, $phonenumber) {

		foreach ( $messages as $key => $message ) {
			$sxml = simplexml_load_string(html_entity_decode($message));
			if ( strcasecmp($sxml->sourcemsisdn, $phonenumber) )
				unset($messages[$key]);
		}
		return $messages;
	}

	static function removeDupes($stored, $new) {
		foreach ( $stored as $value ) {
			if ( array_key_exists($value["ident"], $new) )
				unset($new[$value["ident"]]);
		}
		return $new;
	}

	static function viewify($new) {
		$eot = array();
		foreach ( $new as $value ) {

			$message = simplexml_load_string($value);
			$eot[] = <<<EOT
       
	<div class="statusgroup">
		<div class="statusElement" style="width:100px;">{$message->sourcemsisdn}</div>
		<div class="statusElement" style="width:200px;">{$message->receivedtime}</div>
		<div class="statusElement">{$onoff["{$message->message->msg->s1}"]}</div>
		<div class="statusElement">{$onoff["{$message->message->msg->s2}"]}</div>
		<div class="statusElement">{$onoff["{$message->message->msg->s3}"]}</div>
		<div class="statusElement">{$onoff["{$message->message->msg->s4}"]}</div>
		<div class="statusElement">{$onoff["{$message->message->msg->ht}"]}</div>
		<div class="statusElement">{$motor["{$message->message->msg->mt}"]}</div>
		<div class="statusElement">{$message->message->msg->tp}</div>
		<div class="statusElement">{$username}</div>
		<div class="statusElement">{$preprocessed[$processed]}</div>
		<div class="statusElement fakebutton">Click!</div>
		<br style="clear: both;" />
	</div>
EOT;
			return $eot;
		}
	}

}

?>
