<?php
	require_once('../utilities/error_reporting.php');
	require_once('../controllers/WriteController.php');
	require_once('../utilities/Utility.php');
	
	$util = new Utility();
	$util->startSession();
	
	$write = new WriteController();
	$write->performAction();
?>