<?php
require_once __DIR__.'/../../models/page_models/SignUpModel.php';

session_start();

$sum = new SignUpModel;
if ($sum->signUp($_POST['username'], $_POST['password1'], $_POST['password2'])) {
    echo true;
} else {
    echo false;
}
?>