<?php
require_once('ControllerFactory.php');
require_once('../views/TemplateView.php');
require_once('../models/TemplateModel.php');
require_once('../utilities/Utility.php');


class TemplateController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new TemplateView();
	}
	protected function createModel() {
		return new TemplateModel();
	}
	public function performAction() {
		if () {
		}
	}
}
?>'])) {
			
		}
	}
}
?>edIn();
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