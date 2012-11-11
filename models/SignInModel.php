<?php
require_once('Model.php');
require_once('PersistenceLayer.php');
require_once('InputValidator.php');

class SignInModel extends Model {
	private $error_msg;
	private $iv;
	private $pl;
	
	function __construct() {
		$this->iv = new SignInInputValidator();
		$this->pl = new PersistenceLayer();
	}
	
	// Control Functions
	function signIn($username, $password) {	
		if ($this->iv->signInFilter($username, $password, $this->error_msg)) {
			$this->pl->retrieveUser($username, $password, $this->error_msg);
		}
	}
	
	// Error Functions
	function getErrorMsg() {
		return $this->error_msg;
	}
	private function setErrorMsg($string) {
		$this->error_msg = $string;
	}
}
?>