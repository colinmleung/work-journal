<?php
/**
 * Contains the JournalPageController class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Include the base class of the JournalPageController class. */
require_once('ControllerFactory.php');

/** Include the view of the JournalPageController class. */
require_once('../views/JournalPageView.php');

/** Include the model of the JournalPageController class. */
require_once('../models/JournalPageModel.php');

/**
 * The Controller class for journalpage.php.
 *
 * JournalPageController reads the $_POST superglobal, makes decisions on what to do,
 * and delegates tasks to the JournalPageModel and JournalPageView.
 */
class JournalPageController extends ControllerFactory {

/** Calls the ControllerFactory constructor. */
	function __construct() {
		parent::__construct();
	}
	
/**
 * Constructs a JournalPageView
 * 
 * @return JournalPageView
 */
	protected function createView() {
		return new JournalPageView();
	}
	
/**
 * Constructs a JournalPageModel
 * 
 * @return JournalPageModel
 */
	protected function createModel() {
		return new JournalPageModel();
	}
	
/**
 * Makes decisions based on $_POST variables, and calls class functions to perform the appropriate action.
 *
 * On the journal page, the user can:
 * 1. save their data
 * 2. go to the next day's entry
 * 3. go to the previous day's entry
 * 4. sign out
*/
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

/** Save the current entry. */
	private function saveData() {
		$this->model->saveData($_POST['tasksp'], $_POST['tasksc'], $_POST['issues']);
		$this->model->getData();
		$this->view->display($this->model);
	}
	
/** Go to the next day's entry. */
	private function incrementDay() {
		$this->model->incrementDay();
		$this->model->getData();
		$this->view->display($this->model);
	}
	
/** Go the previous day's entry. */
	private function decrementDay() {
		$this->model->decrementDay();
		$this->model->getData();
		$this->view->display($this->model);
	}
	
/** Go to the sign in page. */
	private function signOut() {
		$this->model->signOut();
		$this->utility->redirect('signin');
	}
	
/** Just display the page. */
	private function noActionTaken() {
		$this->model->getData();
		$this->view->display($this->model);
	}
}
?>