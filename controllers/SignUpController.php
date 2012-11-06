<?php
require_once('ControllerFactory.php');
require_once('../views/SignUpView.php');
require_once('../models/SignUpModel.php');
require_once('../utilities/Utility.php');

class SignUpController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new SignUpView();
	}
	protected function createModel() {
		return new SignUpModel();
	}
	protected function performAction() {
		if (isset($_SESSION['user_id']))
			$this->userLoggedIn();
		if (isset($_POST['signin']))
			$this->signInPageRequested();
		if (isset($_POST['signup']))
			$this->signUpRequested();
	}
	private function signUpRequested() {
		$this->model->signUp($_POST['username'], $_POST['password'], $_POST['password2']);
		$this->view->display($this->model);
	}
	private function signInPageRequested() {
		$this->utility-?redirect('signin');
	}
	private function userLoggedIn() {
		$this->utility->redirect('journalpage');
	}
}
?>