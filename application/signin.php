<?php
	require_once('class_lib.php');
	require_once('start_session.php');
	
	$sic = new SignInController();
	$sic->performAction();
?>