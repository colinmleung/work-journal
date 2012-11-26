<?php
require_once __DIR__.'\..\models\page_models\TemplatesModel.php';

session_start();

$template['name'] = $_POST['name'];
$template['header'] = json_decode($_POST['header']);
$tm = new TemplatesModel;
$tm->addTemplateHeader($template);
echo true;
?>