<?php 

require_once('connect_vars.php');


// Use the Abstract Factory design pattern to maintain the MVC relationship throughout all of the application pages

// Factories
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
	abstract protected function performAction();
}

class SignInController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new SignInView();
	}
	protected function createModel() {
		return new SignInModel();
	}
	protected function performAction() {
		if (isset($_SESSION['user_id']))	
			$this->userLoggedIn();
		if (isset($_POST['signin']))		
			$this->signInRequested();								
		if (isset ($_POST['signup']))
			$this->signUpPageRequested();
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

class SignUpController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new SignUpView();
	}
	protected function createModel() {
		return new SignUpModel();
	}
	protected function performAction() {
		if (isset($_SESSION['user_id']))
			$this->userLoggedIn();
		if (isset($_POST['signin']))
			$this->signInPageRequested();
		if (isset($_POST['signup']))
			$this->signUpRequested();
	}
	private function signUpRequested() {
		$this->model->signUp($_POST['username'], $_POST['password'], $_POST['password2']);
		$this->view->display($this->model);
	}
	private function signInPageRequested() {
		$this->utility-?redirect('signin');
	}
	private function userLoggedIn() {
		$this->utility->redirect('journalpage');
	}
}

class JournalPageController extends ControllerFactory {
	function __construct() {
		parent::__construct();
	}
	protected function createView() {
		return new JournalPageView();
	}
	protected function createModel() {
		return new JournalPageModel();
	}
	protected function performAction() {
		if (isset($_POST['save']))
			$this->saveData();
		if (isset($_POST['forward']))
			$this->incrementDay();
		if (isset($_POST['backward']))
			$this->decrementDay();
		if (isset($_POST['signout']))
			$this->signOut();
	}
	private function saveData() {
		$this->model->saveData();
	}
	private function incrementDay() {
	}
	private function decrementDay() {
	}
	private function signOut() {
		$this->model->signOut();
		$this->utility->redirect('signin');
	}
}

// Products
abstract class View {
	abstract protected function display($model);
}

class SignInView extends View {
	protected function display($model) {
			private $str1 = <<<EOD
!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Work Journal - Record and reflect on your work</title>
		<meta name="description" content="A place to think about your work. Work Journal is a questionnaire creator that improves your productivity by getting you to think about the questions that really matter."/>
	</head>
	<body>
		<header>
				<h1>Work Journal</h1>
				<p>A place to think about your work.</p>
		</header>
		<div id="features">
			<div id="record">
				<h2>Record</h2>
				<p>Preserve your thoughts and feelings right when they happen.</p>
			</div>
			<div id="reflect">
				<h2>Reflect</h2>
				<p>Get a bird's-eye view of your work and identify key issues.</p>
			</div>
			<div id="templates">
				<h2>Custom Templates</h2>
				<p>Create questionnaires to ask yourself those important questions day after day.</p>
			</div>
		</div>
		<div id="signUp">
			<form method="link" action="signup.php">
				<input type="submit" value="Sign Up" name="signup">
			</form>
		</div>
		<div id="logIn">
EOD;

		private $str2 = <<<EOD
			<form id ="signinForm" name="signinForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">		
				<div>
					<label for="username">Username</label>
					<input type="text" id="username" name="username"/>
				</div>
				<div>
					<label for="password">Password</label>
					<input type="password" id="password" name="password"/>
				</div>
				<input type="submit" value="Sign In" name="signin"/>
			</form>
		</div>
	</body>
</html>
EOD;
	
	function display($model) {
		echo $str1;
		if (isset($model->error_msg))
			echo '<p class="error">' . $model->error_msg . '</p>';
		echo $str2;
	}
}

class SignUpView extends View {
	private $s1 = <<<EOD
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Sign Up for Work Journal</title>
		<meta name="description" content="A place to think about your work. Work Journal is a questionnaire creator that improves your productivity by getting you to think about the questions that really matter."/>
	</head>
	<body>
		<p>Sign Up</p>
		<form name="signUpForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required="required"/>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required="required"/>
			<label for="password2">Retype Password:</label>
			<input type="password" id="password2" name="password2" required="required"/>
			<input type="submit" value="Submit" name="submit"/>
		</form>
	</body>
</html>
EOD;

	protected function display($model) {
		echo $str1;
	}
}

class JournalPageView extends View {
	private $s1 = <<<EOD
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>WorkJournal</title>
	</head>
	<body>
		<form name="journal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			Tasks Planned: <textarea name="tasksp" id="tasksp" rows="3" cols="30"><?php echo $model->tasksp ?></textarea>
			Tasks Completed: <textarea name="tasksc" id="tasksc" rows="3" cols="30"><?php echo $model->tasksc ?></textarea>
			Issues: <textarea name="issues" id="issues" rows="3" cols="30"><?php echo $model->issues ?></textarea>
			<input type="submit" value="Save" name="save"/>
			<input type="submit" value="Forward" name="forward"/>
			<input type="submit" value="Backward" name="backward"/>
			<input type="submit" value="Sign Out" name="signout"/>
		</form>
	</body>
</html>
EOD;
	protected function display($model) {
		echo $str1;
	}
}

abstract class Model {
}

class SignInModel extends Model {
}

class SignUpModel extends Model {
}

class JournalPageModel extends Model {
}

// End of MVC Abstract Factory Pattern

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

class Utility {
	private function redirect($string) {
		$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $string . '.php';
		header('Location: ' . $url);
	}
}
?>