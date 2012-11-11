<?php
/**
 * Contains the ReadController class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Include the base class of the ReadController class. */
require_once('ControllerFactory.php');

/** Include the view of the ReadController class. */
require_once('../views/ReadView.php');

/** Include the model of the ReadController class. */
require_once('../models/ReadModel.php');

/**
 * The Controller class for read.php.
 *
 * ReadController reads the $_POST superglobal, makes decisions on what to do,
 * and delegates tasks to the ReadModel and ReadView.
 */
class ReadController extends ControllerFactory {

/** Calls the ControllerFactory constructor. */
	function __construct() {
		parent::__construct();
	}
	
/**
 * Constructs a ReadView
 * 
 * @return ReadView
 */
	protected function createView() {
		return new ReadView();
	}
	
/**
 * Constructs a ReadModel
 * 
 * @return ReadModel
 */
	protected function createModel() {
		return new ReadModel();
	}
	
/** 
 * Makes decisions based on $_POST variables, and calls class functions to perform the appropriate action.
 *
 * On the read page, the user can:
 * 1. sign out
 * 2. go the write page
 * 3. go the templates page
 * 4. read today's entry
 * 5. read all the entries this week
 * 6. read all the entries this month
 * 7. read all the entries this semester
*/
	function performAction() {
		if ($_POST['signout']) {
			$this->signOut();
		} else if ($_POST['write']) {
			$this->write();
		} else if ($_POST['templates']) {
			$this->templates();
		} else if ($_POST['day']) {
			$this->readDay();
		} else if ($_POST['week']) {
			$this->readWeek();
		} else if ($_POST['month']) {
			$this->readMonth();
		} else if ($_POST['semester']) {
			$this->readSemester();
		} else {
			$this->readDay();
		}
	}
	
/** Sign out the user. */
	private function signOut() {
		$this->utility->redirect('signin');
	}

/** Go to the write page. */
	private function write() {
		$this->utility->redirect('write');
	}
	
/** Go to the templates page. */
	private function templates() {
		$this->utility->redirect('templates');
	}
	
/** Show today's entry. */
	private function readDay() {
		$this->model->exposeDay();
		$this->view->display($this->model);
	}
	
/** Show all the entries this week. */
	private function readWeek() {
		$this->model->exposeWeek();
		$this->view->display($this->model);
	}

/** Show all the entries this month. */	
	private function readMonth() {
		$this->model->exposeMonth();
		$this->view->display($this->model);
	}
	
/** Show all the entries this semester. */
	private function readSemester() {
		$this->model->exposeSemester();
		$this->view->display($this->model);
	}
}
?>