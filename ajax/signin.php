<?php
require_once __DIR__.'\..\models\page_models\SignInModel.php';

session_start();

$sim = new SignInModel;
if ($sim->signIn($_POST['username'], $_POST['password'])) {
    echo true;
} else {
    echo false;
}
?>