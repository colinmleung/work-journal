<?php
class Utility {
	public function redirect($string) {
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $string . '.php';
		header('Location: ' . $url);
	}
	public function startSession() {
		session_start();
	
		/*if(!isset($_SESSION['user_id'])) {
			if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
				$_SESSION['user_id'] = $_COOKIE['user_id'];
				$_SESSION['username'] = $_COOKIE['username'];
			}
		}*/
	}
}
?>