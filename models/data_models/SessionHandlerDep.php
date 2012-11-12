<?php
class SessionHandlerDep extends Model {
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
	function setWorkingEntry($entry) {
		$_SESSION['entry'] = $entry;
	}
	function getWorkingEntry() {
		return $_SESSION['entry'];
	}
	function setWorkingEntryId($entry_id) {
		$_SESSION['entry']['entry_id'] = $entry_id;
	}
	function getWorkingEntryId() {
		return $_SESSION['entry']['entry_id'];
	}
	function setReading($reading) {
		$_SESSION['reading'] = $reading;
	}
	function getReading() {
		return $_SESSION['reading'];
	}
}
?>