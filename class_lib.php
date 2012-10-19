<?php

	class DBConnection {
		private $db_conn;
		
		function __construct($db_host, $db_user, $db_password, $db_name) {
			try {
				$db_conn = new PDO($db_name, $db_host, $db_user, $db_password);
				$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		
		function getData($query) {
			return $this->db_conn->query($query)->fetchAll();
		}
		
		function query($query) {
			return $this->db_conn->query($query);
		}
		
		function getNumRows($query) {
			return $this->db_conn->query($query)->rowCount();
		}
		
		function validateUserLogin($username, $password) {
			$db_conn->beginTransaction();
			$query = $db_conn->prepare("SELECT user_id FROM workjournal_user WHERE username = :username and password = :password");
			$query->bindParam(':username', $username, PDO::PARAM_STR);
			$query->bindParam(':password', $password, PDO::PARAM_STR);
			$query->execute();
			$db_conn->commit();
		}
		
		
	}
	
	class SessionHandler {
	}
	
	class DateObject {
	}
?>