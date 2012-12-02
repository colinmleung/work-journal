<?php
/**
 * write_save.php
 *
 * PHP Version 5. AJAX script to save an entry. Called by function saveAttempt in writeModel.js.
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

$entry['header'] = json_decode($_POST['entry_headers']);
$entry['response'] = json_decode($_POST['entry_responses']);

$wm = new WriteModel;
if ($wm->saveEntry($entry)) {
    echo true;
} else {
    echo false;
}
?>