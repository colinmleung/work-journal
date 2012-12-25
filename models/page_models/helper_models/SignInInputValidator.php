<?php
require_once(__DIR__.'/InputValidator.php');
class SignInInputValidator extends InputValidator {
	function __construct() {
		parent::__construct();
	}
	function signInFilter($username, $password, &$error_msg) {
		if ($this->nullStringCheck($username) && $this->nullStringCheck($password)) {
			if (($this->sanitizeString($username) === trim($username)) &&
					($this->sanitizeString($password) == trim($password))) {
				return true;
			} else {
				$error_msg = 'No special characters allowed in the username or password.';
				return false;
			}
		} else {
			$error_msg = 'Enter a username and password.';
			return false;
		}
	}
}
?>