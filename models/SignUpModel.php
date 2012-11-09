<?php
require_once('Model.php');
require_once('PersistenceLayer.php');
require_once('InputValidator.php');

class SignUpModel extends Model {
	private $error_msg;
	private $iv;
	private $pl;
	
	function __construct() {
		$this->iv = new InputValidator();
		$this->pl = new PersistenceLayer();
	}
	function signUp($username, $password1, $password2) {
		if ($this->iv->signUpFilter($username, $password1, $password2, $this->error_msg)) {
			$this->pl->insertUser($username, $password1, $this->error_msg);
		}
	}
	function getErrorMsg() {
		return $this->error_msg;
	}
	private function setErrorMsg($string) {
		$this->error_msg = $string;
	}
}
?>