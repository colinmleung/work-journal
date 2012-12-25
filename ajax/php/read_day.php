<?php
/**
 * read_day.php
 *
 * PHP Version 5. AJAX script to retrieve entries from today. Called by function readDayAttempt in readModel.js.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.5
 */

require_once __DIR__.'/../../models/page_models/ReadModel.php';

session_start();

$rm = new ReadModel;
$rm->exposeDay();
$reading = $rm->getReading();
echo json_encode($reading);
?>