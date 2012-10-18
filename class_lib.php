<?php

	class DBConnection {
		private $db_conn;
		
		function __construct($db_host, $db_user, $db_password, $db_name) {
			$this->db_conn = new mysqli($db_host, $db_user, $db_password, $db_name);
			if ($this->db_conn->connect_error) {
				die('Connect Error (' . $this->db_conn->connect_errno . ') ' . $this->db_conn->connect_error); 
			}
		}
		
		function getData($query) {
			return $this->db_conn->query($query)->fetch_array();
		}
		
		function query($query) {
			return $this->db_conn->query($query);
		}
		
		function getNumRows($query) {
			return $this->db_conn->query($query)->num_rows;
		}
		
		function validateString($string) {
			return $this->db_conn->real_escape_string($string);
		}
		
	}
	
	class SessionHandler {
	}
	
	class DateObject {
	}
?>