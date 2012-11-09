<?php
require_once('Model.php');
require_once('PersistenceLayer.php');
require_once('InputValidator.php');

class SignInModel extends Model {
	private $error_msg;
	private $iv;
	private $pl;
	
	function __construct() {
		$this->iv = new InputValidator();
		$this->pl = new PersistenceLayer();
	}
	function signIn($username, $password) {	
		if ($this->iv->signInFilter($username, $password, $this->error_msg)) {
			$this->pl->retrieveUser($username, $password, $this->error_msg);
		}
	}
	function getErrorMsg() {
		return $this->error_msg;
	}
	private function setErrorMsg($string) {
		$this->error_msg = $string;
	}
}
?>ry = "SELECT user_id, username FROM workjournal_user WHERE username = '$username' AND password = SHA('$password')";
				$qro = new QRO($dao->query($query));
				if ($qro->numRows() == 1) {
					// The log-in is OK so set the user ID and username variables
					$row = $qro->fetchArray();
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['curdate'] = date('Y-m-d', time());
					setcookie('user_id', $row['user_id'], time() + THIRTY_DAYS);
					setcookie('username', $row['username'], time() + THIRTY_DAYS);
					return true;
				} else {
					// The username/passwordd are incorrect so set an error message
					$this->setErrorMsg('Sorry, you must enter a valid username and password to log in.');
					return false;
				}
			} else {
				// The username/password weren't entered so set an error message
				$this->setErrorMsg('Sorry, you must enter your username and password to log in.');
				return false;
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