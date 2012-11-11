<?php
/**
 * Contains the WriteController class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
 /** Include the base class of the WriteController class. */
require_once('ControllerFactory.php');

/** Include the view of the WriteController class. */
require_once('../views/WriteView.php');

/** Include the model of the WriteController class. */
require_once('../models/WriteModel.php');

/**
 * The Controller class for write.php.
 *
 * WriteController reads the $_POST superglobal, makes decisions on what to do,
 * and delegates tasks to the WriteModel and WriteView.
 */
class WriteController extends ControllerFactory {

/** Calls the ControllerFactory constructor. */
	function __construct() {
		parent::__construct();
	}
	
/**
 * Constructs a WriteView
 * 
 * @return WriteView
 */
	protected function createView() {
		return new WriteView();
	}
	
/**
 * Constructs a WriteModel
 * 
 * @return WriteModel
 */
	protected function createModel() {
		return new WriteModel();
	}
	
/** 
 * Makes decisions based on $_POST variables, and calls class functions to perform the appropriate action.
 *
 * On the write page, the user can:
 * 1. sign out
 * 2. go the read page
 * 3. go the templates page
 * 4. create a new entry
 * 5. save the current entry
 * 6. delete the current entry
 * 7. clear the current entry
 * 8. go to the next day
 * 9. go the previous day
*/
	function performAction() {
		if ($_POST['signout']) {
			$this->signOut();
		} else if ($_POST['read']) {
			$this->read();
		} else if ($_POST['templates']) {
			$this->templates();
		} else if ($_POST['create']) {
			$this->createNewEntry();
		} else if ($_POST['save']) {
			$this->saveEntry();
		} else if ($_POST['delete']) {
			$this->deleteEntry();
		} else if ($_POST['clear']) {
			$this->clearEntry();
		} else if ($_POST['forward']) {
			$this->incrementDate();
		} else if ($_POST['backward']) {
			$this->decrementDate();
		} else {
			$this->showDefaultEntry();
		}
	}
	
/** Sign out the user. */
	private function signOut() {
		$this->utility->redirect('signin');
	}
	
/** Go to the read page. */
	private function read() {
		$this->utility->redirect('read');
	}
	
/** Go to the templates page. */
	private function templates() {
		$this->utility->redirect('templates');
	}
	
/** Create a new journal entry. */
	private function createNewEntry() {
		$this->model->createNewEntry($_POST['template_name']);
		$this->view->display($this->model);
	}
	
/** Save the current entry. */
	private function saveEntry() {
		$this->model->saveEntry($_POST['entry']);
		$this->view->display($this->model);
	}
	
/** Delete the current entry. */
	private function deleteEntry() {
		$this->model->deleteEntry();
		$this->view->display($this->model);
	}
	
/** Clear the current entry. */
	private function clearEntry() {
		$this->model->clearEntry();
		$this->view->display($this->model);
	}
	
/* Show the default blank entry. */
	private function showDefaultEntry() {
		$this->model->showDefaultEntry();
		$this->view->display($this->model);
	}
	
/** Go the next day's entry. */
	private function incrementDate() {
		$this->model->incrementDate();
		$this->view->display($this->model);
	}
	
/** Go the previous day's entry. */
	private function decrementDate() {
		$this->model->decrementDate();
		$this->view->display($this->model);
	}
}
?>