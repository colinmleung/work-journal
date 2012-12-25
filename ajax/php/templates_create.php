<?php
/**
 * templates_create.php
 *
 * PHP Version 5. AJAX script to create a template. Called by function createAttempt in templatesModel.js.
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
$tm->createNewTemplate();
echo true;
?>