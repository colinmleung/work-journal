<?php
require_once __DIR__.'\..\models\page_models\WriteModel.php';

session_start();

$wm = new WriteModel;

//var_dump($wm->getDate());
$wm->decrementDate();
//var_dump($wm->getDate());
$date = $wm->getDate();
$timestamp = strtotime($date);
echo $timestamp;
?>