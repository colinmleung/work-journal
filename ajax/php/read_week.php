<?php
require_once __DIR__.'/../../models/page_models/ReadModel.php';

session_start();

$rm = new ReadModel;
$rm->exposeWeek();
$reading = $rm->getReading();
echo json_encode($reading);
?>