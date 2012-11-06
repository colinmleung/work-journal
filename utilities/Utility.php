<?php
class Utility {
	private function redirect($string) {
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $string . '.php';
		header('Location: ' . $url);
	}
}
?>