<?php
require_once('View.php');

class ReadView extends View {
	public function display($model) {
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Work Journal - Read</title>
		<meta name="description" content="A place to think about your work. Work Journal is a questionnaire creator that improves your productivity by getting you to think about the questions that really matter."/>
	</head>
	<body>
		<header>
			<h1>Read</h1>
		</header>
		<nav>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
				<input type="submit" value="Write" name="write"/>
				<input type="submit" value="Read" name="read"/>
				<input type="submit" value="Templates" name="templates"/>
				<input type="submit" value="Sign Out" name="signout"/>
			</form>
		</nav>
		<div id="actionBar">
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
				<input type="submit" value="Daily View" name="day"/>
				<input type="submit" value="Weekly View" name="week"/>
				<input type="submit" value="Monthly View" name="month"/>
				<input type="submit" value="Semesterly View" name="semester"/>
			</form>
		</div>
		<div id="journal">
			<div id="entry">
<?php
			$entry_headers = $model->getEntryHeaders();
			$entry_responses = $model->getEntryResponses();
			for ($i = 0; $i < count($entry_headers); $i++) {
				$entry_header = $entry_headers[$i];
				$entry_response = $entry_responses[$i];
				echo '<p>' . $entry_header . '</p>';
				echo '<p>' . $entry_response . '</p>';
			}
?>
			</div>
		</div>
	</body>
</html>