<?php
require_once __DIR__.'\..\models\page_models\WriteModel.php';
//require_once __DIR__.'\..\views\WriteView.php';

session_start();

$entry['header'] = json_decode($_POST['entry_h']);
$entry['response'] = json_decode($_POST['entry_r']);

$wm = new WriteModel;
//$wv = new WriteView;
if ($wm->saveEntry($entry)) {
    //$wv->display($wm);
    echo true;
} else {
    //$wv->display($wm);
    echo false;
}
            
?>