<?php
require_once('View.php');

class SignInView extends View {
	public function display($model) {
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Work Journal - <?php echo $_SESSION['curdate'] ?></title>
		<meta name="description" content="A place to think about your work. Work Journal is a questionnaire creator that improves your productivity by getting you to think about the questions that really matter."/>
	</head>
	<body>
		<header>
			<h1><?php echo $_SESSION['curdate'] ?></h1>
		</header>
		<nav>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
				<input type="submit" value="Write" name="write"/>
				<input type="submit" value="Read" name="read"/>
				<input type="submit" value="Templates" name="templates"/>
				<input type="submit" value="Sign Out" name="signout"/>
			</form>
		</nav>
		<div id="journal">
			<div id="actionBar">
			<form name="entry" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
				<select>
					<option value="blank">Blank</option>
<?php
					$template_names = $model->getTemplateNames();
					foreach ($template_names as $template_name) {
						echo '<option value="' . $template_name . '">' . $template_name . '</option>';
					}
?>
				</select>
				<input type="submit" value="Create New Entry" name="create"/>
				<input type="submit" value="Save" name="save"/>
				<input type="submit" value="Delete" name="delete"/>
				<input type="submit" value="Clear" name="clear"/>
			</form>
			</div>
			<div id="entry">
<?php
			$entry_headers = $model->getEntryHeaders();
			$entry_responses = $model->getEntryResponses();
			for ($i = 0; $i < count($entry_headers); $i++) {
				$entry_header = $entry_headers[$i];
				$entry_response = $entry_responses[$i];
				echo '<textarea form="entry" rows="1" cols="200" name="' . $entry_header . '">' . $entry_header . '</textarea>';
				echo '<textarea form="entry" rows="10" cols="200" name="' . $entry_response . '">' . $entry_response . '</textarea>';
			}
?>				
			</div>
		</div>
	</body>
</html>