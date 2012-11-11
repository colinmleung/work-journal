<?php
require_once('ControllerFactory.php');
require_once('../views/TemplatesView.php');
require_once('../models/TemplatesModel.php');
require_once('../utilities/Utility.php');


class TemplatesController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new TemplatesView();
	}
	protected function createModel() {
		return new TemplatesModel();
	}
	public function performAction() {
		if () {
		}
	}
}
?>