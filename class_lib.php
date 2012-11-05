<?php 

require_once('connect_vars.php');
	
class Model {
	public $text;
	
	public function __construct() {
		$this->text = 'Hello World';
	}

}

class View {
	protected $model;
	protected $controller;
}

class Controller {
}

// Database Access Object acts as a facade to the mysqli object
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

// Query Result Object acts as a facade to the mysqli result object
class QRO {
	private $mysqli_result;
	
	function __construct($mysqli_result) {
		$this->mysqli_result = $mysqli_result;
	}
	
	function numRows() {
		return $this->mysqli_result->num_rows;
	}
	
	function fetchArray() {
		return $this->mysqli_result->fetch_array(MYSQLI_BOTH);
	}
}
?>