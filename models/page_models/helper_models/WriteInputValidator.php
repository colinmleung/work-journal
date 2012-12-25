<?php
require_once(__DIR__.'/InputValidator.php');
class WriteInputValidator extends InputValidator {
	function __construct() {
		parent::__construct();
	}
	function writeFilter($entry, &$error_msg) {
        $entry_string = implode($entry['header']) + implode($entry['response']);
		if ($this->nullStringCheck($entry_string)) {
			if ($this->sanitizeString($entry_string) === trim($entry_string)) {
				return true;
			} else {
				$error_msg = 'No special characters allowed in the journal entry.';
				return false;
			}
		} else {
			$error_msg = 'There is nothing written in this entry.';
			return false;
		}
	}
}
?>