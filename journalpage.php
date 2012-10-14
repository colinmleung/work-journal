<?php
	require_once('startsession.php');
	require_once('header.php');
	require_once('connect_vars.php');
	
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$tasksp = '';
	$tasksc = '';
	$issues = '';
	
	//echo '<p>post data = '.$_POST['submit'].'</p>';
	
	if(isset($_POST['submit'])) {
			$tasksp = $_POST['tasksp'];
			$tasksc = $_POST['tasksc'];
			$issues = $_POST['issues'];
			
			// Send text information to database
			$query = "UPDATE workjournal_user SET tasksp = '".$tasksp."', tasksc = '".$tasksc."', issues = '".$issues."' WHERE user_id ='".$_SESSION['user_id']."'";
			mysqli_query($dbc, $query);
	}
	
	// Get text information from database
	$query = "SELECT tasksp, tasksc, issues FROM workjournal_user WHERE user_id='".$_SESSION['user_id']."'";
	$data = mysqli_query($dbc, $query);
	$row = mysqli_fetch_array($data);
	
	$tasksp = $row['tasksp'];
	$tasksc = $row['tasksc'];
	$issues = $row['issues'];
?>

<form name="journal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			Tasks Planned: <textarea name="tasksp" id="tasksp" rows="3" cols="30"><?php echo $tasksp ?></textarea>
			Tasks Completed: <textarea name="tasksc" id="tasksc" rows="3" cols="30"><?php echo $tasksc ?></textarea>
			Issues: <textarea name="issues" id="issues" rows="3" cols="30"><?php echo $issues ?></textarea>
			<input type="submit" value="Save" name="submit">
</form>

<a href="signout.php">Log Out</a>

<?php
	require_once('footer.php');
?>