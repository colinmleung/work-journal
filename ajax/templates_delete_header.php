<?php
require_once __DIR__.'\..\models\page_models\TemplatesModel.php';

session_start();

$tm = new TemplatesModel;
$tm->deleteTemplateHeader($delete_array, $template);
echo true;
?>