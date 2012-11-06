<?php 
require_once('connect_vars.php');

class DAO {
	private $mysqli;
	
	function __construct() {
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}
	
	function sanitizeString($string) {
		return $this->mysqli->real_escape_string(trim($string));
	}
	
	function query($query) {
		return $this->mysqli->query($query);
	}
	
	function __destruct() {
		$this->mysqli->close();
	}
}
?>