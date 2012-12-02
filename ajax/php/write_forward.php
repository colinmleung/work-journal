<?php
/**
 * write_forward.php
 *
 * PHP Version 5. AJAX script to advance one day. Called by function forwardAttempt in writeModel.js.
 *
 * PHP Version 5
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.5
 */

require_once __DIR__.'/../../models/page_models/WriteModel.php';

session_start();

$wm = new WriteModel;

$wm->incrementDate();
$date = $wm->getDate();
$timestamp = strtotime($date);
echo $timestamp;
?>