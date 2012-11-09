<?php
require_once('ControllerFactory.php');
require_once('../views/WriteView.php');
require_once('../models/WriteModel.php');
require_once('../utilities/Utility.php');


class WriteController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new WriteView();
	}
	protected function createModel() {
		return new WriteModel();
	}
	public function performAction() {
		if ($_POST['signout']) {
			$this->signOut();
		} else if ($_POST['create']) {
			$this->createEntry();
		} else if ($_POST['save']) {
			$this->saveEntry();
		} else if ($_POST['delete']) {
			$this->deleteEntry();
		} else if ($_POST['clear']) {
			$this->clearEntry();
		} else if ($_POST['forward']) {
			$this->incrementDay();
		} else if ($_POST['backward']) {
			$this->decrementDay();
		} else {
			$this->showDefaultEntry();
		}
	}
	private function signOut() {
	}
	private function createEntry() {
	}
	private function saveEntry() {
	}
	private function deleteEntry() {
	}
	private function clearEntry() {
	}
	private function showDefaultEntry() {
	}
	private function incrementDay() {
		$this->model->incrementDay($_SESSION['curdate']);
	}
	private function decrementDay() {
		$this->model->decrementDay($_SESSION['curdate']);
	}
}
?>