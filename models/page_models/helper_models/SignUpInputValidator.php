<?php
require_once __DIR__.'\InputValidator.php';
class SignUpInputValidator extends InputValidator
{
	// sanitize all strings, check if passwords are equal
	// empty spaces before/after are okay
	// character changes due to sanitize are not
	function signUpFilter($username, $password1, $password2, &$error_msg) {
		if ($this->nullStringCheck($username) && $this->nullStringCheck($password1) && $this->nullStringCheck($password2)) {
			if ((($this->sanitizeString($username)) === trim($username)) &&
					(($this->sanitizeString($password1)) === trim($password1)) &&
					(($this->sanitizeString($password2)) === trim($password2))) {
				if ($this->equalStringCheck($password1, $password2)) {
					return true;
				} else {
					$error_msg = 'The two passwords do not match.';
					return false;
				}
			} else {
				$error_msg = 'No special characters allowed in the username or password.';
				return false;
			}
		} else {
			$error_msg = 'Username and passwords must be filled out.';
			return false;
		}
	}
}
?>