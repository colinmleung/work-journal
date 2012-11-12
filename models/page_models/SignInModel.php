<?php
require_once(__DIR__.'\..\Model.php');
require_once(__DIR__.'\..\data_models\PersistenceLayer.php');
require_once(__DIR__.'\helper_models\SignInInputValidator.php');

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