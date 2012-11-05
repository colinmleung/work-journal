<?php
	require_once('startsession.php');
	require_once('header.php');
	require_once('class_lib.php');
	
	if(isset($_POST['forward'])) {
		$_SESSION['curdate'] = date("Y-m-d", strtotime($_SESSION['curdate'])+86400);
	}
	
	if(isset($_POST['backward'])) {
		$_SESSION['curdate'] = date("Y-m-d", strtotime($_SESSION['curdate'])-86400);
	}
	
	// Connect to the database
	$dbc = new DAO;
	
	$tasksp = '';
	$tasksc = '';
	$issues = '';
	
	echo '<p>date = '.$_SESSION['curdate'].'</p>';
	
	if(isset($_POST['submit'])) {
	
			// check for existing dated workjournal page
			$query = "SELECT * FROM workjournal_data WHERE user_id ='".$_SESSION['user_id']."' AND date = '".$_SESSION['curdate']."'";
			$qro = new QRO($dbc->query($query));
			$row = $qro->fetchArray();
			
			// If no date exists
			if ($qro->numRows == 0) {
				// create a record of one
				$query = "INSERT INTO workjournal_data (user_id, date) VALUES ('".$_SESSION['user_id']."', '".$_SESSION['curdate']."')";
				$dbc->query($query);
			}
			
			// Transfer data to variables
			$tasksp = $_POST['tasksp'];
			$tasksc = $_POST['tasksc'];
			$issues = $_POST['issues'];
			
			// Send text information to database
			$query = "UPDATE workjournal_data SET tasksp = '".$tasksp."', tasksc = '".$tasksc."', issues = '".$issues."' WHERE user_id ='".$_SESSION['user_id']."' AND date = '".$_SESSION['curdate']."'";
			$dbc->query($query);
	}
	
	// Get text information from database
	$query = "SELECT tasksp, tasksc, issues FROM workjournal_data WHERE user_id ='".$_SESSION['user_id']."' AND date = '".$_SESSION['curdate']."'";
	$qro = new QRO($dbc->query($query));
	//echo '<p>data = '.$data.'</p>';
	$row = $qro->fetchArray();
	
	$tasksp = $row['tasksp'];
	$tasksc = $row['tasksc'];
	$issues = $row['issues'];
?>

<form name="journal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
			Tasks Planned: <textarea name="tasksp" id="tasksp" rows="3" cols="30"><?php echo $tasksp ?></textarea>
			Tasks Completed: <textarea name="tasksc" id="tasksc" rows="3" cols="30"><?php echo $tasksc ?></textarea>
			Issues: <textarea name="issues" id="issues" rows="3" cols="30"><?php echo $issues ?></textarea>
			<input type="submit" value="Save" name="submit"/>
			<input type="submit" value="Forward" name="forward"/>
			<input type="submit" value="Backward" name="backward"/>
</form>

<a href="forward.php">Forward</a>
<a href="backward.php">Backward</a>
<a href="signout.php">Log Out</a>

	</body>
</html>