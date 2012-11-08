<?php
require_once('View.php');

class JournalPageView extends View {

	public function display($model) {
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>WorkJournal</title>
	</head>
	<body>
		<p>date = <?php echo $_SESSION['curdate'] ?></p>
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
<?php
	}
}
?>