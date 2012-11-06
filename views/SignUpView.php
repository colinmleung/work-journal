<?php
require_once('View.php');

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
?>