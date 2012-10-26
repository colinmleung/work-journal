<?php
	require_once('connect_vars.php');

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	if (isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
		$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
		$password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
		
		if (!empty($username) && !empty($password) && !empty($password2) && ($password == $password2)) {
			$query = "SELECT * FROM workjournal_user WHERE username='$username'";
			
			$data = mysqli_query($dbc, $query);
			if (mysqli_num_rows($data) == 0) {
				$query = "INSERT INTO workjournal_user (username, password) VALUES ('$username', SHA('$password'))";
				mysqli_query($dbc, $query);
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/signin.php';
				header('Location: ' . $home_url);
				mysqli_close($dbc);
				exit();
			} else {
				echo '<p>Username already taken. Please try another one.</p>';
			}
		} else {
			echo '<p>Please enter the desired username and the desired password twice.</p>';
		}
	}
	mysqli_close($dbc);
?>

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