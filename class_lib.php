<?php

	class DBConnection {
		private $db_conn;
		
		function __construct($db_host, $db_user, $db_password, $db_name) {
			$this->db_conn = new mysqli($db_host, $db_user, $db_password, $db_name);
		}
		
		function query($query) {
			$data = $db_conn->query($query);
			return $db_conn->mysqli_fetch_array($data);
		}
		
		function numDataRows($query) {
			return $db_conn->mysqli_num_rows($db_conn->query($query));
		}
		
		function validateString($string) {
			return $db_conn->real_escape_string($string);
		}
	}
	
	class SessionHandler {
	}
	
	class DateObject {
	}
?>