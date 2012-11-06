<?php
	require_once('class_lib.php');
	require_once('start_session.php');
	
	$jpc = new JournalPageController();
	$jpc->performAction();
?>