<?php
/**
 * Contains the TemplatesController class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Include the base class of the TemplatesController class. */
require_once('ControllerFactory.php');

/** Include the view of the TemplatesController class. */
require_once('../views/TemplatesView.php');

/** Include the model of the TemplatesController class. */
require_once('../models/TemplatesModel.php');

/**
 * The Controller class for templates.php.
 *
 * TemplatesController reads the $_POST superglobal, makes decisions on what to do,
 * and delegates tasks to the TemplatesModel and TemplatesView.
 */
class TemplatesController extends ControllerFactory {

/** Calls the ControllerFactory constructor. */
	function __construct() {
		parent::__construct();
	}
	
/**
 * Constructs a TemplatesView
 * 
 * @return TemplatesView
 */
	protected function createView() {
		return new TemplatesView();
	}
	
/**
 * Constructs a TemplatesModel
 * 
 * @return TemplatesModel
 */
	protected function createModel() {
		return new TemplatesModel();
	}
	
/** 
 * Makes decisions based on $_POST variables, and calls class functions to perform the appropriate action.
 *
 * On the templates page, the user can:
 * 1. sign out
 * 2. go the write page
 * 3. go the read page
 * 4. create a new templates
 * 5. load an existing template
 * 6. save the current template
 * 7. modify the existing template
*/
	function performAction() {
		if ($_POST['signout']) {
			$this->signOut();
		} else if ($_POST['read']) {
			$this->read();
		} else if ($_POST['write']) {
			$this->write();
		} else if ($_POST['create']) {
			$this->createNewTemplate();
		} else if ($_POST['save']) {
			$this->saveTemplate();
		} else if ($_POST['delete']) {
			$this->deleteTemplate();
		} else if ($_POST['modify']) {
			$this->modifyTemplate();
		} else {
			$this->createNewTemplate();
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
	
/** Go to the read page. */
	private function read() {
		$this->utility->redirect('read');
	}
	
/** Create a new template. */
	private function createNewTemplate() {
		$this->model->createNewTemplate();
		$this->view->display($this->model);
	}
	
/** Save the current template. */
	private function saveTemplate() {
		$this->model->saveTemplate($_POST['template']);
		$this->view->display($this->model);
	}
	
/** Delete the current template. */
	private function deleteTemplate() {
		$this->model->deleteTemplate($_POST['template']['name']);
		$this->view->display($this->model);
	}
	
/** Modify the current template. */
	private function modifyTemplate() {
		$this->model->modifyTemplate($_POST['template']);
		$this->view->display($this->model);
	}
}
?>