<?php
abstract class ControllerFactory {
	protected $view;
	protected $model;
	protected $utility;
	
	function __construct() {
		$this->view = $this->createView();
		$this->model = $this->createModel();
		$this->utility = new Utility();
	}
	abstract protected function createView();
	abstract protected function createModel();
	abstract public function performAction();
}
?>
