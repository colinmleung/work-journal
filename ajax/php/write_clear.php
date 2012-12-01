<?php
require_once __DIR__.'/../../models/page_models/WriteModel.php';

session_start();

$wm = new WriteModel;

$wm->clearEntry($entry);
echo true;
?>