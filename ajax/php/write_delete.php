<?php
require_once __DIR__.'/../../models/page_models/WriteModel.php';

session_start();

$wm = new WriteModel;
if ($wm->deleteEntry()) {
    echo true;
} else {
    echo false;
}
?>