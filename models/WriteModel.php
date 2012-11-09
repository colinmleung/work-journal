<?php
require_once('Model.php');
require_once('DAO.php');
require_once('QRO.php');
require_once('../utilities/constants.php');

class WriteModel extends Model {
	private $error_msg;
	private $template_questions;
	private $template_responses;
	private $template_names;
	
	public function saveData($tasksp, $tasksc, $issues) {
		$dbc = new DAO;
		
		// check for existing dated workjournal page
		$query = "SELECT * FROM workjournal_data WHERE user_id ='".$_SESSION['user_id']."' AND date = '".$_SESSION['curdate']."'";
		$qro = new QRO($dbc->query($query));
		$row = $qro->fetchArray();
		
		// If no date exists
		if ($qro->numRows() == NO_RECORDS) {
			// create a record of one
			$query = "INSERT INTO workjournal_data (user_id, date) VALUES ('".$_SESSION['user_id']."', '".$_SESSION['curdate']."')";
			$dbc->query($query);
		}
		
		// Send text information to database
		$query = "UPDATE workjournal_data SET tasksp = '".$tasksp."', tasksc = '".$tasksc."', issues = '".$issues."' WHERE user_id ='".$_SESSION['user_id']."' AND date = '".$_SESSION['curdate']."'";
		$dbc->query($query);
	}
	public function incrementDay() {
		$_SESSION['curdate'] = date("Y-m-d", strtotime($_SESSION['curdate'])+DAY);
	}
	public function decrementDay() {
		$_SESSION['curdate'] = date("Y-m-d", strtotime($_SESSION['curdate'])-DAY);
	}
	public function signOut() {
		if (isset($_SESSION['user_id'])) {
			$_SESSION = array();
			
			if(isset($_COOKIE[session_name()])) {
				setcookie(session_name(), '', time() - 1);
			}
			
			session_destroy();
		}
	
		setcookie('user_id', '', time() - 1);
		setcookie('username', '', time() - 1);
		setcookie('curdate', '', time() - 1);
	}
	public function getErrorMsg() {
		return $this->error_msg;
	}
	private function setErrorMsg($string) {
		$this->error_msg = $string;
	}
	public function getData() {
		$dbc = new DAO;
		$query = "SELECT tasksp, tasksc, issues FROM workjournal_data WHERE user_id ='".$_SESSION['user_id']."' AND date = '".$_SESSION['curdate']."'";
		$qro = new QRO($dbc->query($query));
		$row = $qro->fetchArray();
	
		$this->tasksp = $row['tasksp'];
		$this->tasksc = $row['tasksc'];
		$this->issues = $row['issues'];
	}
	public function getTemplateQuestions() {
		return $model->template_questions;
	}
	public function getTemplateNames() {
		return $model->template_names;
	}
	public function getTemplateResponses() {
		return $model->template_responses;
	}
	private function getEntry($template_name, $date, $number) {
		$dbc = new DAO;
		$query = "SELECT "
	}
	public function getData() {
	}
}
?>