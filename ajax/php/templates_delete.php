<?php
/**
 * templates_delete.php
 *
 * PHP Version 5. AJAX script to delete a template. Called by function deleteAttempt in templatesModel.js.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.5
 */

require_once __DIR__.'/../../models/page_models/TemplatesModel.php';

session_start();

$tm = new TemplatesModel;
$tm->deleteTemplate();
echo true;
?>