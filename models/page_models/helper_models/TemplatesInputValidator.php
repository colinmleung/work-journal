<?php
require_once(__DIR__.'/InputValidator.php');
class TemplatesInputValidator extends InputValidator {
	function __construct() {
		parent::__construct();
	}

	function templatesFilter($template, &$error_msg) {
        $template_string = implode($template['header']);
		if ($this->nullStringCheck($template_string)) {
			if ($this->sanitizeString($template_string) === trim($template_string)) {
				return true;
			} else {
				$error_msg = 'No special characters allowed in the template.';
				return false;
			}
		} else {
			$error_msg = 'There are no questions in the template.';
			return false;
		}
	}
}
?>