<?php
/**
 * Contains the SignUpController class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
 /** Include the base class of the SignUpController class. */
require_once('ControllerFactory.php');

/** Include the view of the SignUpController class. */
require_once('../views/SignUpView.php');

/** Include the model of the SignUpController class. */
require_once('../models/SignUpModel.php');

/**
 * The Controller class for signup.php.
 *
 * SignUpController reads the $_POST superglobal, makes decisions on what to do,
 * and delegates tasks to the SignUpModel and SignUpView.
 */
class SignUpController extends ControllerFactory {

/** Calls the ControllerFactory constructor. */
	function __construct() {
		parent::__construct();
	}
	
/**
 * Constructs a SignUpView
 * 
 * @return SignUpView
 */
	protected function createView() {
		return new SignUpView();
	}
	
/**
 * Constructs a SignUpModel
 * 
 * @return SignUpModel
 */
	protected function createModel() {
		return new SignUpModel();
	}
	
/** 
 * Makes decisions based on $_POST variables, and calls class functions to perform the appropriate action.
 *
 * On the sign up page, the user can:
 * 1. sign up
 * 2. go the sign in page
 * 3. be already logged in
*/
	public function performAction() {
		if (isset($_SESSION['user_id'])) {
			$this->userLoggedIn();
		} else if (isset($_POST['signin'])) {
			$this->signInPageRequested();
		} else if (isset($_POST['signup'])) {
			$this->signUpRequested();
		} else {
			$this->noActionTaken();
		}
	}
	
/** Just display the page. */
	private function noActionTaken() {
		$this->view->display($this->model);
	}

/** Attempt to sign the user up. */
	private function signUpRequested() {
		if ($this->model->signUp($_POST['username'], $_POST['password1'], $_POST['password2'])) {
			$this->utility->redirect('signin');
		}
		$this->view->display($this->model);
	}
	
/** Go to the sign in page. */
	private function signInPageRequested() {
		$this->utility->redirect('signin');
	}
	
/** Go to the journal page */
	private function userLoggedIn() {
		$this->utility->redirect('journalpage');
	}
}
?>