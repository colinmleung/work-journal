<?php
require_once('Model.php');
require_once('DAO.php');
require_once('QRO.php');
require_once('../utilities/constants.php');

class SignInModel extends Model {
	private $error_msg;
	
	public function signIn($username, $password) {
		$dao = new DAO();
		if (!empty($username) && !empty($password)) {
				// Look up the username and password in the database
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
					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/journalpage.php';
					header('Location: ' . $home_url);
				} else {
					// The username/passwordd are incorrect so set an error message
					$this->setErrorMsg('Sorry, you must enter a valid username and password to log in.');
				}
			} else {
				// The username/password weren't entered so set an error message
				$this->setErrorMsg('Sorry, you must enter your username and password to log in.');
			}
	}
	public function getErrorMsg() {
		return $this->error_msg;
	}
	private function setErrorMsg($string) {
		$this->error_msg = $string;
	}
}
?>