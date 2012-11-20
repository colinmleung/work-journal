<?php
require_once(__DIR__.'/../Model.php');
require_once(__DIR__.'/../data_models/SignInPersistenceLayer.php');
require_once(__DIR__.'/helper_models/SignInInputValidator.php');

class SignInModel extends Model {
	private $error_msg;
	private $iv;
	private $pl;
	
	function __construct() {
		$this->iv = new SignInInputValidator();
		$this->pl = new SignInPersistenceLayer();
	}
	
	// Control Functions
	function signIn($username, $password) {	
		if ($this->iv->signInFilter($username, $password, $this->error_msg)) {
			if ($this->pl->retrieveUser($username, $password, $this->error_msg)) {
                return true;
            }
		}
        return false;
	}
	
	// Error Functions
	function getErrorMsg() {
		return $this->error_msg;
	}
}
?>