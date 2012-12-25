<?php
require_once(__DIR__.'/../../data_models/DAO.php');

abstract class InputValidator extends Model {
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
}
?>