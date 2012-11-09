<?php
require_once('ControllerFactory.php');
require_once('../views/SignInView.php');
require_once('../models/SignInModel.php');
require_once('../utilities/Utility.php');

// The SignInController manages interactions between the SignInView and SignInModel, as well as the browser itself.
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
	public function performAction() {
		if (isset($_SESSION['user_id'])) {
			$this->userLoggedIn();
		} else if (isset($_POST['signin'])) {
			$this->signInRequested();
		} else if (isset ($_POST['signup'])) {
			$this->signUpPageRequested();
		} else {
			$this->noActionTaken();
		}
	}
	private function noActionTaken() {
		$this->view->display($this->model);
	}
	private function signInRequested() {
		if ($this->model->signIn($_POST['username'], $_POST['password']))
			redirect('journalpage');
		else 
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