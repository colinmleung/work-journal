<?php
/**
 * templates_save.php
 *
 * PHP Version 5. AJAX script to save a template. Called by function saveAttempt in templatesModel.js.
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

$tm = new TemplatesModel;
$tm->saveTemplate($template);
echo true;
?>