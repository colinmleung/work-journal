<?php
require_once(__DIR__.'/../Model.php');
require_once(__DIR__.'/../data_models/SignUpPersistenceLayer.php');
require_once(__DIR__.'/helper_models/SignUpInputValidator.php');

class SignUpModel extends Model {
	private $error_msg;
	private $iv;
	private $pl;
	
	function __construct() {
		$this->iv = new SignUpInputValidator();
		$this->pl = new SignUpPersistenceLayer();
	}
	function signUp($username, $password1, $password2) {
		if ($this->iv->signUpFilter($username, $password1, $password2, $this->error_msg)) {
			if ($this->pl->insertUser($username, $password1, $this->error_msg)) {
                return true;
            }
		}
        return false;
	}
	function getErrorMsg()
    {
		return $this->error_msg;
	}
    
    /*function deleteUser(&$error_msg) {
		$user_id = $this->sh->getUserId();
		$search_query = "SELECT user_id FROM workjournal_user WHERE user_id = '$user_id'";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() == USER_EXISTS) {
			$delete_query = "DELETE FROM workjournal_user WHERE user_id = '$user_id'";
			$this->dao->query($delete_query);
			// delete session and cookie variables?
			return true;
		} else {
			$error_msg = 'User could not be found.';
			return false;
		}
	}*/
}
?>