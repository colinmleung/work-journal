<?php 

require_once('connect_vars.php');
	
class Model {
	public $text;
	
	public function __construct() {
		$this->text = 'Hello World';
	}

}

class View {
	protected $model;
	protected $controller;
}

class SignInController {
	private $user_logged_in;
	private $sign_in_button_pressed;
	private $sign_up_button_pressed;
	private $username;
	private $password;
	private $model;

	function __construct() {		// Since the SignInController is recreated everytime the signin.php page is called, 
									// the constructor can conduct polling for user-input data
	
		if (isset($_SESSION['user_id']))	// check if user logged in already
			$this->user_logged_in = true;		
		if (isset($_POST['signin'])) {		// check if user pressed the sign in button
			$this->sign_in_button_pressed = true;								
			if (isset($_POST['username'])) $this->username = $_POST['username'];
			if (isset($_POST['password'])) $this->password = $_POST['password'];
		}
		if (isset ($_POST['signup']))		// check if user pressed the sign up button
			$this->sign_up_button_pressed = true;		
	}
	
	function performAction() {		// Only decides which action to perform based on polled data
		if ($this->user_logged_in) {
			$this->userLoggedIn();
		} else if ($this->sign_up_button_pressed) {
			$this->signUpButtonPressed();
		} else if ($this->sign_in_button_pressed) {
			$this->signIn();
		}
	}
	
	function signInButtonPressed() {
		$this->model->signIn($this->username, $this->password);
	}
	
	function signUpButtonPressed() {
		redirect('signup');
	}
	
	function userLoggedIn() {
		redirect('journalpage');
	}
	
	// Utility function for redirecting to other pages
	function redirect($string) {
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $string . '.php';
		header('Location: ' . $url);
	}	
}

// Database Access Object acts as a facade to the mysqli object
class DAO {
	private $mysqli;
	
	function __construct() {
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}
	
	function sanitizeString($string) {
		return $this->mysqli->real_escape_string(trim($string));
	}
	
	function query($query) {
		return $this->mysqli->query($query);
	}
	
	function __destruct() {
		$this->mysqli->close();
	}
}

// Query Result Object acts as a facade to the mysqli result object
class QRO {
	private $mysqli_result;
	
	function __construct($mysqli_result) {
		$this->mysqli_result = $mysqli_result;
	}
	
	function numRows() {
		return $this->mysqli_result->num_rows;
	}
	
	function fetchArray() {
		return $this->mysqli_result->fetch_array(MYSQLI_BOTH);
	}
}

// Session Handling Object
class SHO {	
}

// Cookie Handling Object
class CHO {
}

class User {
	private $user_id;
	private $username;
	private $password;
	
	function __construct() {
	}
	
	function SignIn($user_id, ) {
	}
}
?>