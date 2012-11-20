<?php
//require DAO

class User
{
    private $dao;

    private $user_id;
    private $username;
    private $password;
    
    function __construct() {
        $this->dao = new DAO;
    }
    
    function __constructDefault() {
        $user = new self();
        $user->user_id = null;
        return $user;
    }
    
    function __constructWithId($id) {
        $user = new self();
        $user->user_id = $id;
        return $user;
    }
    
    // Getters and Setters
    
    function getUserId() {
        return $this->user_id;
    }
    
    function getUsername() {
        return $this->username;
    }
    
    function setUsername($name) {
        $this->username = $name;
    }
    
    function getPassword() {
        return $this->password;
    }
    
    function setPassword($password) {
        $this->password = $password;
    }
    
    // Domain Logic Methods
    
    function getJournal() {
    }
    
    function getTemplatesNames() {
    }
    
    // SQL Operation Methods
    
    static function find($user_id) {
        $search_query = "SELECT user_id, username FROM workjournal_user WHERE username = '$username' AND password = SHA('$password')";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() == 1) {
			$row = $qro->fetchArray();
            $this->user_id = $user_id;
            $this->username = $;
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
    
    static function load($db_rs) {
    }
    
    function update() {
    }
    
    function insert() {
    }
    
    function delete() {
    }
}
?>