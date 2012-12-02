<?php
/**
 * write_create.php
 *
 * PHP Version 5. AJAX script to create an entry. Called by function createAttempt in writeModel.js.
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

$template_name = $_POST['template_name'];

$wm = new WriteModel;
$new_entry = $wm->createNewEntry($template_name);
echo json_encode($new_entry);
?>