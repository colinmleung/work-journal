<?php
require_once('Model.php');
require_once('DAO.php');
require_once('QRO.php');
require_once('../utilities/constants.php');

class SignUpModel extends Model {
	private $error_msg;
	
	public function signUp($username, $password1, $password2) {
		$dao = new DAO();
		$username = $dao->sanitizeString($username);
		$password1 = $dao->sanitizeString($password1);
		$password2 = $dao->sanitizeString($password2);
		
		if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
			$query = "SELECT * FROM workjournal_user WHERE username='$username'";
			
			$qro = new QRO($dao->query($query));
			if ($qro->numRows() == NO_RECORDS) {
				$query = "INSERT INTO workjournal_user (username, password) VALUES ('$username', SHA('$password1'))";
				$dao->query($query);
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/signin.php';
				header('Location: ' . $home_url);
			} else {
				$this->setErrorMsg('Username already taken. Please try another one');
			}
		} else {
			$this->setErrorMsg('Please enter the desired username and the desired password twice.');
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