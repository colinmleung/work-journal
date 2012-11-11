<?php
/**
 * Represents the application page where the user can read work-journal entries.
 *
 * This page is meant to serve as the browser's interface to the read controller.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Necessary for adding more detailed error reports. */
require_once('../utilities/error_reporting.php');

/** Include the page controller */
require_once('../controllers/ReadController.php');

/** Include a catch-all utility class */
require_once('../utilities/Utility.php');

/** @var Utility */
$util = new Utility();
$util->startSession();

/** @var ReadController */
$rc = new ReadController();
$rc->performAction();
?>