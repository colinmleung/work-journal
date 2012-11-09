<?php
require_once('Model.php');
require_once('DAO.php');
require_once('QRO.php');
require_once('SessionHandler.php');

class DatabaseLayer extends Model {
	private $dao;
	private $sh;
	
	function __construct() {
		$dao = new DAO;
		$sh = new SessionHandler;
		$ch = new CookieHandler;
	}
	
	function insertEntry() {
	}
	
	function retrieveEntry() {
	}
	
	function deleteEntry() {
	}
	
	function retrieveTemplate() {
	}
	
	function insertTemplate() {
	}
	
	function deleteTemplate() {
	}
	
	function insertUser() {
	}
	
	// Returns a boolean depending on the result of the sign in attempt.
	function retrieveUser($username, $password, &$error_msg) {
		$dao->sanitizeString($username);
		$dao->sanitizeString($password);
		if (!empty($username) && !empty($password)) {
			$query = "SELECT user_id, username FROM workjournal_user WHERE username = '$username' AND password = SHA('$password')";
			$qro = new QRO($dao->query($query));
			if ($qro->numRows() == 1) {
				// The log-in is OK so set the user ID and username variables
				$row = $qro->fetchArray();
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['curdate'] = date('Y-m-d', time());
				setcookie('user_id', $row['user_id'], time() + THIRTY_DAYS);
				setcookie('username', $row['username'], time() + THIRTY_DAYS);
			} else {
				// The username/password are incorrect so set an error message
				$error_msg = 'Sorry, you must enter a valid username and password to log in.';
			}
		} else {
			// The username/password weren't entered so set an error message
			$error_msg = 'Sorry, you must enter your username and password to log in.';
		}
	}
	
	function deleteUser() {
	}
}
?>