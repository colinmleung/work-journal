<?php 
require_once __DIR__.'/../../utilities/connect_vars.php';

// The Database Access Object acts as a facade over the mysqli object.
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