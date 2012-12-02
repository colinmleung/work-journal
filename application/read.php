<?php
/**
 * read.php
 *
 * PHP Version 5. This page is meant to serve as the browser's interface to the
 * read controller.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 */
 
/** Necessary for adding more detailed error reports. */
require_once __DIR__.'/../utilities/error_reporting.php';

/** Include the page controller */
require_once __DIR__.'/../controllers/ReadController.php';

/** Include a catch-all utility class */
require_once __DIR__.'/../utilities/Utility.php';

/** @var Utility */
$util = new Utility();
$util->startSession();

/** @var ReadController */
$rc = new ReadController();
$rc->performAction();
?>