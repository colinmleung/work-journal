<?php
	require_once('class_lib.php');
	require_once('start_session.php');
	
	$suc = new SignUpController();
	$suc->performAction();
?> = $dbc->sanitizeString($_POST['username']);
		$password = $dbc->sanitizeString($_POST['password']);
		$password2 = $dbc->sanitizeString($_POST['password2']);
		
		
		if (!empty($username) && !empty($password) && !empty($password2) && ($password == $password2)) {
			$query = "SELECT * FROM workjournal_user WHERE username='$username'";
			
			$qro = new QRO($dbc->query($query));
			if ($qro->numRows() == NO_RECORDS) {
				$query = "INSERT INTO workjournal_user (username, password) VALUES ('$username', SHA('$password'))";
				$dbc->query($query);
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/signin.php';
				header('Location: ' . $home_url);
				exit();
			} else {
				echo '<p>Username already taken. Please try another one.</p>';
			}
		} else {
			echo '<p>Please enter the desired username and the desired password twice.</p>';
		}
	}
?>