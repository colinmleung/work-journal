<?php
/**
 * Contains the SignInController class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
 /** Include the base class of the SignInController class. */
require_once('ControllerFactory.php');

/** Include the view of the SignInController class. */
require_once('../views/SignInView.php');

/** Include the model of the SignInController class. */
require_once('../models/SignInModel.php');

/**
 * The Controller class for signin.php.
 *
 * SignInController reads the $_POST superglobal, makes decisions on what to do,
 * and delegates tasks to the SignInModel and SignInView.
 */
class SignInController extends ControllerFactory {

/** Calls the ControllerFactory constructor. */
	function __construct() {
		parent::__construct();
	}
	
/**
 * Constructs a SignInView
 * 
 * @return SignInView
 */
	protected function createView() {
		return new SignInView();
	}
	
/**
 * Constructs a SignInModel
 * 
 * @return SignInModel
 */
	protected function createModel() {
		return new SignInModel();
	}
	
/** 
 * Makes decisions based on $_POST variables, and calls class functions to perform the appropriate action.
 *
 * On the sign in page, the user can:
 * 1. log in
 * 2. go the sign up page
 * 3. be already logged in
*/
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
	
/** Just display the page. */
	private function noActionTaken() {
		$this->view->display($this->model);
	}

/** Attempt to log in the user. */
	private function signInRequested() {
		if ($this->model->signIn($_POST['username'], $_POST['password']))
			redirect('journalpage');
		else 
			$this->view->display($this->model);
	}
	
/** Go to the sign up page. */
	private function signUpPageRequested() {
		$this->utility->redirect('signup');
	}
	
/** Go to the journal page. */
	private function userLoggedIn() {
		$this->utility->redirect('journalpage');
	}
}
?>