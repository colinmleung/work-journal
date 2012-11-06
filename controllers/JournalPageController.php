<?php
require_once('ControllerFactory.php');
require_once('../views/JournalPageView.php');
require_once('../models/JournalPageModel.php');
require_once('../utilities/Utility.php');

class JournalPageController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new JournalPageView();
	}
	protected function createModel() {
		return new JournalPageModel();
	}
	protected function performAction() {
		if (isset($_POST['save']))
			$this->saveData();
		if (isset($_POST['forward']))
			$this->incrementDay();
		if (isset($_POST['backward']))
			$this->decrementDay();
		if (isset($_POST['signout']))
			$this->signOut();
	}
	private function saveData() {
		$this->model->saveData();
	}
	private function incrementDay() {
	}
	private function decrementDay() {
	}
	private function signOut() {
		$this->model->signOut();
		$this->utility->redirect('signin');
	}
}
?>