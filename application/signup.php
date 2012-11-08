<?php
	require_once('../utilities/error_reporting.php');
	require_once('../controllers/SignUpController.php');
	require_once('../utilities/Utility.php');
	
	$util = new Utility();
	$util->startSession();
	
	$suc = new SignUpController();
	$suc->performAction();
?>