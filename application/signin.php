<?php
	require_once('SignInController.php');
	require_once('../utilities/Utility.php');
	
	$util = new Utility();
	$util->startSession();
	
	$sic = new SignInController();
	$sic->performAction();
?>