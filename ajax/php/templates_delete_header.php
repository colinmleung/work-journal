<?php
require_once __DIR__.'/../../models/page_models/TemplatesModel.php';

session_start();

$template['name'] = $_POST['name'];
$template['header'] = json_decode($_POST['headers']);
$delete_array = json_decode($_POST['delete_array']);

$tm = new TemplatesModel;
$tm->deleteTemplateHeader($delete_array, $template);
echo $_POST['delete_array'];
?>