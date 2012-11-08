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
	public function performAction() {
		if (isset($_POST['save'])) {
			$this->saveData();
		} else if (isset($_POST['forward'])) {
			$this->incrementDay();
		} else if (isset($_POST['backward'])) {
			$this->decrementDay();
		} else if (isset($_POST['signout'])) {
			$this->signOut();
		} else {
			$this->noActionTaken();
		}
	}
	private function saveData() {
		$this->model->saveData($_POST['tasksp'], $_POST['tasksc'], $_POST['issues']);
		$this->model->getData();
		$this->view->display($this->model);
	}
	private function incrementDay() {
		$this->model->incrementDay();
		$this->model->getData();
		$this->view->display($this->model);
	}
	private function decrementDay() {
		$this->model->decrementDay();
		$this->model->getData();
		$this->view->display($this->model);
	}
	private function signOut() {
		$this->model->signOut();
		$this->utility->redirect('signin');
	}
	private function noActionTaken() {
		$this->model->getData();
		$this->view->display($this->model);
	}
}
?>