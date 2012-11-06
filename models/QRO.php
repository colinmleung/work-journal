<?php
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