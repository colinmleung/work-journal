<?php
require_once('Model.php');
require_once('DAO.php');
require_once('QRO.php');
require_once('../utilities/constants.php');

class WriteModel extends Model {
	private $error_msg;
	private $iv;
	private $pl;
	
	function _construct() {
		$this->iv = new WriteInputValidator();
		$this->pl = new PersistenceLayer();
	}
	
	// Control Functions
	function createNewEntry($template_name) {
		$this->pl->createNewEntry($template_name);
	}
	function saveEntry($entry) {
		if ($this->iv->writeFilter($entry, &$error_msg))
		$this->pl->insertEntry($entry);
	}
	function deleteEntry() {
		$this->pl->deleteEntry();
	}
	function clearEntry() {
		$this->pl->clearEntry();
	}
	function showDefaultEntry() {
		$this->pl->defaultEntry();
	}
	
	function incrementDate() {
		$this->pl->incrementDate();
	}
	function decrementDate() {
		$this->pl->decrementDate();
	}
	
	// View Functions
	function getDate() {
		return $this->pl->getDate();
	}
	function getTemplateNames() {
		return $this->pl->getTemplateNames();
	}
	function getEntry() {
		return $this->pl->retrieveEntry();
	}
	
	// Error Functions
	function getErrorMsg() {
		return $this->error_msg;
	}
	private function setErrorMsg($string) {
		$this->error_msg = $string;
	}
}
?>