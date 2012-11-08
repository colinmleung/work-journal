<?php
	require_once('../utilities/error_reporting.php');
	require_once('../controllers/SignInController.php');
	require_once('../utilities/Utility.php');
	
	$util = new Utility();
	$util->startSession();
	
	$sic = new SignInController();
	$sic->performAction();
?>