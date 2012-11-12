<?php
require_once(__DIR__.'\..\Model.php');
require_once('DAO.php');
require_once('QRO.php');
require_once('SessionHandlerDep.php');
require_once('CookieHandler.php');

// Acts as the layer interacting between the persistent data stores (db, sessions, cookies) and the higher-level models.
// Input contract: inputs should be pre-sanitized and pre-checked for errors. The only errors that will be reported are errors related to the state of the datastores themselves.
class PersistenceLayer extends Model {
	private $dao;
	private $sh;
	private $ch;
	
	function __construct() {
		$dao = new DAO;
		$sh = new SessionHandlerDep;
		$ch = new CookieHandler;
	}
	
	function setWorkingEntry($entry) {
		$this->sh->setWorkingEntry($entry);
	}
	
	function retrieveWorkingEntry() {
		return $this->sh->getWorkingEntry();
	}
	
	function setBlankWorkingEntry() {
		$entry = array(array("header" => '',
								"response" => ''));
		$this->sh->setWorkingEntry($entry);
	}
	
	function createNewEntry($template_name) {
		// create new entry from template
		return $entry;
	}
	
	function clearWorkingEntry() {
		$working_entry = $this->sh->retrieveWorkingEntry();
		for ($i = 0; $i < count($working_entry); $i++) {
			$working_entry[$i]['response'] = '';
		}
		$this->sh->setWorkingEntry($working_entry);
	}
	
	function insertEntry($entry, &$error_msg) {
		$date = $this->sh->getDate();
		$user_id = $this->sh->getUserId();
		$tco = new TCO;
		$header = $tco->Array2String($header);
		$response = $tco->Array2String($response);
		$insert_query = "INSERT INTO work_journal_entry (user_id, date, entry_header, entry_response) VALUES ('$user_id', '$date', '$header', '$response')";
		$this->dao->query($insert_query);
		
		//set the entry id
		$search_query = "SELECT entry_id WHERE user_id = '$user_id' AND date = '$date' AND entry_header = '$header' AND entry_response = '$response'";
		$qro = new QRO($this->dao->query($search_query));
		$row = $qro->fetchArray();
		$this->sh->setWorkingEntryId($row['entry_id']);
		return true;
	}
	
	//entries should be a two dimensional array
	function retrieveEntry(&$entries, $date, &$error_msg) {
		$user_id = $this->sh->getUserId();
		$tco = new TCO;
		$search_entry = "SELECT entry_header, entry_response WHERE user_id = '$user_id' AND date = '$date'";
		$qro = new QRO($this->dao->query($search_query));
		for ($i = 0; i < $qro->numRows(); $i++) {
			$row = $qro->fetchRow();
			$entries[i][0] = $row['entry_header'];
			$entries[i][1] = $row['entry_response'];
		}
		return true;
	}
	
	function checkEntryId() {
		$entry_id = $this->sh->getWorkingEntryId();
		return isset($entry_id);
	}
	
	function deleteEntry(&$error_msg) {
		$user_id = $this->sh->getUserId();
		$entry_id = $this->getWorkingEntryId();
		$delete_query = "DELETE FROM workjournal_entry WHERE user_id= '$user_id' AND entry_id = '$entry_id'";;
		$qro = new QRO($this->dao->query($delete_query));
		// ENTRY_DELETED = 1
		if ($qro->numRows() != ENTRY_DELETED) {
			$error_msg = 'Entry does not exist.';
			return false;
		}
		return true;
	}
	
	function retrieveTemplate($user_id, $template_name, &$template, &$error_msg) {
		$tco = new TCO;
		$search_query = "SELECT template_text FROM workjournal_template WHERE user_id = '$user_id' AND template_name = '$template_name'";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() == TEMPLATE_EXISTS) {
			$row = $qro->fetchArray();
			$template = $tco->String2Array($row['template_text']);
		} else {
			$error_msg = 'Template does not exist.';
			return false;
		}
	}
	
	//$template is an array of questions, with a name at index 0
	function insertTemplate($template, &$error_msg) {
		$user_id = $this->sh->getUserId();
		$tco = new TCO;
		$search_query = "SELECT * FROM workjournal_templates WHERE user_id = '$user_id' AND template_name = '$template[0]'";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() != TEMPLATE_EXISTS) {
			$template_text = $tco->Array2String($template);
			$insert_query = "INSERT INTO workjournal_templates (user_id, template_name, template_text) VALUES ('$user_id', '$template[0]', '$template_text')";
			$this->dao->query($insert_query);
			return true;
		} else {
			$error_msg = 'Template name taken.';
			return false;
		}
	}
	
	function deleteTemplate($template_name, &$error_msg) {
		$user_id = $this->sh->getUserId();
		$delete_query = "DELETE FROM workjournal_templates WHERE user_id = '$user_id' AND template_name = '$template_name'";
		$qro = new QRO($this->dao->query($delete_query));
		// TEMPLATE_DELETED = 1
		if ($qro->numRows() != TEMPLATE_DELETED) {
			$error_msg = 'Template does not exist.';
			return false;
		}
		return true;
	}
	
	function insertUser($username, $password, &$error_msg) {
		$search_query = "SELECT user_id, username FROM workjournal_user WHERE username = '$username' AND password = SHA('$password')";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() != USER_EXISTS) {
			$insert_query = "INSERT INTO workjournal_user (username, password) VALUES ('$username', SHA('$password'))";
			$this->dao->query($insert_query);
			return true;
		} else {
			$error_msg = 'Username taken.';
			return false;
		}
	}
	
	// Returns a boolean depending on the result of the sign in attempt. Also modifies an input error message depending on the failure.
	function retrieveUser($username, $password, &$error_msg) {
		$search_query = "SELECT user_id, username FROM workjournal_user WHERE username = '$username' AND password = SHA('$password')";
		$qro = new QRO($this->dao->query($search_query));
		if ($qro->numRows() == USER_EXISTS) {
			$row = $qro->fetchArray();
			$this->sh->setUserId($row['user_id']);
			$this->sh->setUserName($row['username']);
			$this->sh->setDate($row['date']);
			$this->ch->setUserId($row['user_id']);
			$this->ch->setUserName($row['username']);
			return true;
		} else {
			$error_msg = 'Invalid username and password combination.';
			return false;
		}
	}
	
	function deleteUser(&$error_msg) {
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
	}
	
	function getDate() {
		return $this->sh->getDate();
	}
	
	function getReading() {
		return $this->sh->getReading();	
	}
	
	function setReading($num_days) {
		$user_id = $this->sh->getUserId();
		$date = $this->getDate();
		for ($i = 0; $i < $num_days; $i++) {
			$this->retrieveEntry($reading[i], $date, $error_msg);
		}
		$this->sh->setReading($reading);
	}
}
?>