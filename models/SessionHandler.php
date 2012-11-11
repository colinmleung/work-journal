<?php
class SessionHandler extends Model {
	function setUserId($user_id) {
		$_SESSION['user_id'] = $user_id;
	}
	function getUserId() {
		return $_SESSION['user_id'];
	}
	function setUserName($username) {
		$_SESSION['username'] = $username;
	}
	function getUserName() {
		return $_SESSION['username'];
	}
	function setDate($date) {
		$_SESSION['date'] = $date;
	}
	function getDate() {
		return $_SESSION['date'];
	}
}
?>