<?php
class CookieHandler extends Model {
	private $cookie_lifetime;
	
	function setLifetime($seconds) {
		$this->cookie_lifetime = $seconds;
	}
	function setUserId($user_id) {
		setcookie('user_id', $user_id, time() + $cookie_lifetime);
	}
	function getUserId() {
		return $_COOKIE['user_id'];
	}
	function setUserName($username) {
		setcookie('username', $username, time() + $cookie_lifetime);
	}
	function getUserName() {
		return $_COOKIE['username'];
	}
	function setCurrentDate($cur_date) {
		setcookie('cur_date', $cur_date, time() + $cookie_lifetime);
	}
	function getCurrentDate() {
		return $_COOKIE['cur_date'];
	}
}
?>	}
}
?>