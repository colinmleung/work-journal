<?php
	require_once('class_lib.php');
	
	session_start();
	
	// Clear the error message
	$error_msg = "";
	
	// If the user isn't logged in, try to log them in
	if (!isset($_SESSION['user_id'])) {
		if(isset($_POST['signin'])) {
			// Connect to the database
			$dbc = new DAO;
			
			// Grab the user-entered log-in data
			$user_username = $dbc->sanitizeString($_POST['username']);
			$user_password = $dbc->sanitizeString($_POST['password']);
			
			if (!empty($user_username) && !empty($user_password)) {
				// Look up the username and password in the database
				$query = "SELECT user_id, username FROM workjournal_user WHERE username = '$user_username' AND password = SHA('$user_password')";
				$qro = new QRO($dbc->query($query));
			
				if ($qro->numRows() == 1) {
					// The log-in is OK so set the user ID and username variables
					$row = $qro->fetchArray();
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['curdate'] = date('Y-m-d', time());
					setcookie('user_id', $row['user_id'], time() + THIRTY_DAYS);
					setcookie('username', $row['username'], time() + THIRTY_DAYS);
					$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/journalpage.php';
					header('Location: ' . $home_url);
				} else {
					// The username/password are incorrect so set an error message
					$error_msg = 'Sorry, you must enter a valid username and password to log in.';
				}
			} else {
				// The username/password weren't entered so set an error message
				$error_msg = 'Sorry, you must enter your username and password to log in.';
			}
		}
	}
?>

<!doctype html>
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

<?php
	// If the cookie is empty, show any error message and the log-in form; otherwise confirm the log-in
	if (empty($_SESSION['user_id'])) {
		echo '<p class="error">' . $error_msg . '</p>';
?>
		
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

<?php
	} else {
		// Confirm the successful log in
		echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '</p>');
	}
?>
		</div>
		<script src="js/ajax.js"></script>
		<script src="js/utilities.js"></script>
		<script src="js/errorMessages.js"></script>
		<script src="js/signin.js"></script>
	</body>
</html>