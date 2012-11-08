<?php
require_once('View.php');

class SignUpView extends View {
	public function display($model) {
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
			<label for="password1">Password:</label>
			<input type="password" id="password1" name="password1" required="required"/>
			<label for="password2">Retype Password:</label>
			<input type="password" id="password2" name="password2" required="required"/>
			<input type="submit" value="Sign Up" name="signup"/>
		</form>
		<form name="signInButton" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="submit" value="Sign In" name="signin"/>
		</form>
<?php
$error_msg = $model->getErrorMsg();
if (isset($error_msg))
	echo '<p class="error">' . $error_msg . '</p>';
?>
	</body>
</html>
<?php
	}
}
?>