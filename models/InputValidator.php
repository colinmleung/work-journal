<?php
require_once('DAO.php');

class InputValidator extends Model {
	private $dao;
	
	function __construct() {
		$this->dao = new DAO;
	}
	
	function sanitizeString($string) {
		return $this->dao->sanitizeString($string);
	}
	
	// Returns false if string is empty.
	function nullStringCheck($string) {
		return ($string !== "");
	}
	
	// Return true if strings are equal
	function equalStringCheck($string1, $string2) {
		return ($string1 === $string2);
	}
	
	// sanitize all strings, check if passwords are equal
	// empty spaces before/after are okay
	// character changes due to sanitize are not
	function signUpFilter($username, $password1, $password2, &$error_msg) {
		if ($this->nullStringCheck($username) && $this->nullStringCheck($password1) && $this->nullStringCheck($password2)) {
			if ((($this->sanitizeString($username) === trim($username)) &&
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
?> false;
		}
	}
}
?>