<?php
	require_once('../utilities/error_reporting.php');
	require_once('../controllers/JournalPageController.php');
	require_once('../utilities/Utility.php');
	
	$util = new Utility();
	$util->startSession();
	
	$jpc = new JournalPageController();
	$jpc->performAction();
?>