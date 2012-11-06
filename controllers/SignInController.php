<?php
require_once('ControllerFactory.php');
require_once('../views/SignInView.php');
require_once('../models/SignInModel.php');
require_once('../utilities/Utility.php');


class SignInController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new SignInView();
	}
	protected function createModel() {
		return new SignInModel();
	}
	protected function performAction() {
		if (isset($_SESSION['user_id']))	
			$this->userLoggedIn();
		if (isset($_POST['signin']))		
			$this->signInRequested();								
		if (isset ($_POST['signup']))
			$this->signUpPageRequested();
	}
	private function signInRequested() {
		$this->model->signIn($_POST['username'], $_POST['password']);
		$this->view->display($this->model);
	}
	private function signUpPageRequested() {
		$this->utility->redirect('signup');
	}
	private function userLoggedIn() {
		$this->utility->redirect('journalpage');
	}
}
?>