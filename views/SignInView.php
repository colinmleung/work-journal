<?php
require_once('View.php');

class SignInView extends View {
	public function display($model) {
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
$error_msg = $model->getErrorMsg();
if (isset($error_msg))
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
		</div>
	</body>
</html>
<?php
	}
}
?>