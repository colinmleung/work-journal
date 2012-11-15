<?php
require_once __DIR__.'/PersistenceLayer.php';

class SignInPersistenceLayer extends PersistenceLayer
{
    function __construct()
    {
        parent::__construct();
    }

    // Returns a boolean depending on the result of the sign in attempt. Also modifies an input error message depending on the failure.
	function retrieveUser($username, $password, &$error_msg) {
		$search_query = "SELECT user_id, username FROM workjournal_user WHERE username = '$username' AND password = SHA('$password')";
		$qro = new QRO($this->dao->query($search_query));
        // USER_EXISTS = 1
		if ($qro->numRows() == 1) {
			$row = $qro->fetchArray();
			$this->sh->setUserId($row['user_id']);
			$this->sh->setUserName($row['username']);
            $this->sh->setDate(date('Y-m-d'));
            $this->ch->setLifetime(2592000);
			$this->ch->setUserId($row['user_id']);
			$this->ch->setUserName($row['username']);
			return true;
		} else {
			$error_msg = 'Invalid username and password combination.';
			return false;
		}
	}
}