<?php
require_once __DIR__.'\..\models\page_models\WriteModel.php';

session_start();

$template_name = $_POST['template_name'];

$wm = new WriteModel;
$new_entry = $wm->createNewEntry($template_name);
echo json_encode($new_entry);
?>