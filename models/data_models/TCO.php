<?php
require_once __DIR__.'/../Model.php';

class TCO extends Model {
	public function String2Array($text) {
		return explode("|||", $text);
	}
	public function Array2String($array) {
		return implode("|||", $array);
	}
}
?>