<?php
	require_once('connect_vars.php');
	
	session_start();
	
	// Clear the error message
	$error_msg = "";
	
	// If the user isn't logged in, try to log them in
	if (!isset($_SESSION['user_id'])) {
		if(isset($_POST['submit'])) {
			// Connect to the database
			$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
			
			// Grab the user-entered log-in data
			$user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
			$user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
			
			if (!empty($user_username) && !empty($user_password)) {
				// Look up the username and password in the database
				$query = "SELECT user_id, username FROM workjournal_user WHERE username = '$user_username' AND password = SHA('$user_password')";
				$data = mysqli_query($dbc, $query);
			
				if (mysqli_num_rows($data) == 1) {
					// The log-in is OK so set the user ID and username variables
					$row = mysqli_fetch_array($data);
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['curdate'] = date('Y-m-d', time());
					setcookie('user_id', $row['user_id'], time() + 60*60*24*30);
					setcookie('username', $row['username'], time() + 60*60*24*30);
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
				<input type="submit" value="Sign Up">
			</form>
		</div>
		<div id="logIn">

<?php
	// If the cookie is empty, show any error message and the log-in form; otherwise confirm the log-in
	if (empty($_SESSION['user_id'])) {
		echo '<p class="error">' . $error_msg . '</p>';
?>
		
			<form name="logInForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">		
				<label for="username">Username</label>
				<input type="text" id="username" name="username" required="required"/>
				<label for="password">Password</label>
				<input type="password" id="password" name="password" required="required"/>
				<input type="submit" value="Log In" name="submit"/>
			</form>

<?php
	} else {
		// Confirm the successful log in
		echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '</p>');
	}
?>
		</div>
	</body>
</html>