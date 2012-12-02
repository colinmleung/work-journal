<?php
/**
 * templates_delete_header.php
 *
 * PHP Version 5. AJAX script to delete a template header. Called by function deleteHeaderAttempt in templatesModel.js.
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

$template['name'] = $_POST['name'];
$template['header'] = json_decode($_POST['headers']);
$delete_array = json_decode($_POST['delete_array']);

$tm = new TemplatesModel;
$tm->deleteTemplateHeader($delete_array, $template);
echo $_POST['delete_array'];
?>