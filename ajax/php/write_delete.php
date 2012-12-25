<?php
/**
 * write_delete.php
 *
 * PHP Version 5. AJAX script to delete the entry. Called by function deleteAttempt in writeModel.js.
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
if ($wm->deleteEntry()) {
    echo true;
} else {
    echo false;
}
?>