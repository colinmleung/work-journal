<?php
class Utility {
	public function redirect($string) {
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $string . '.php';
		header('Location: ' . $url);
	}
	public function startSession() {
		session_start();
	}
}
?>