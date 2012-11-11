<?php
/**
 * Represents the application page where the user can sign up.
 *
 * This page is meant to serve as the browser's interface to the sign up controller.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Necessary for adding more detailed error reports. */
require_once('../utilities/error_reporting.php');

/** Include the page controller */
require_once('../controllers/SignUpController.php');

/** Include a catch-all utility class */
require_once('../utilities/Utility.php');

/** @var Utility */
$util = new Utility();
$util->startSession();

/** @var SignUpController */
$suc = new SignUpController();
$suc->performAction();
?>