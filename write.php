<?php
	require_once('startsession.php');
	require_once('header.php');
	require_once('connect_vars.php');
	
	// Connect to the database
	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Work Journal - PLACEHOLDER_FOR_CURRENT_DATE</title>
		<meta name="description" content="A place to think about your work. Work Journal is a questionnaire creator that improves your productivity by getting you to think about the questions that really matter."/>
	</head>
	<body>
		<header>
			<h1>Work Journal</h1> 										<!--logotype-->
		</header>
		<nav> 															<!--navigation bar-->
			<a href="write.php">Write</a>
			<a href="read.php">Read</a>
			<a href="templates.php">Templates</a>
			<a href="logout.php">Log Out</a>
		</nav>
		<select name="templates">										<!--template dropdown menu-->
			<option value="blank">Blank Template</option>
<?php
	// Find out the number of templates available
	$query = "SELECT template_id FROM workjournal_user_template WHERE user_id ='".$_SESSION['user_id']."'";
	$data = mysqli_query($dbc, $query);
	
	// Print out the templates that the user can use
	for (int i = 0; i < mysqli_num_rows($data); i++) {
		$row = mysqli_fetch_array($data);
		$template_id = $row["template_id"];
		$query2 = "SELECT template_name FROM workjournal_template WHERE template_id='".$template_id[i]."'";
		$data2 = mysqli_query($dbc, $query2);
		$row2 = mysqli_fetch_array($data2);
		$template_name = $row["template_name"];
?>
		<option="<?php echo $template_name ?>"><?php echo $template_name ?></option>
<?php
	}
?>
		</select>
		<div id="journal">
			<div id="actionBar">
			<form method="post" action="write.php">
				<input type="submit" value="Create New Entry" name="create"/>
				<input type="submit" value="Save" name="save"/>
				<input type="submit" value="Clear" name="clear"/>
			</form>
			</div>
			<!-- add php code here for template loading -->
		</div>
	</body>
</html>