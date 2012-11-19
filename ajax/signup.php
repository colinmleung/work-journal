<?php
require_once __DIR__.'\..\models\data_models\DAO.php';
require_once __DIR__.'\..\models\data_models\QRO.php';
require_once __DIR__.'\..\utilities\Utility.php';
require_once __DIR__.'\..\models\data_models\SessionHandlerFacade.php';
require_once __DIR__.'\..\models\data_models\CookieHandler.php';

if (!isset($_POST['signin'])) {
    $username = $_POST['username'];
    $password = $_POST['password1'];
    
    $dao = new DAO;
    $search_query = "SELECT user_id, username FROM workjournal_user WHERE username = '$username'";
    $qro = new QRO($dao->query($search_query));
    if ($qro->numRows() != 1) {
            $insert_query = "INSERT INTO workjournal_user (username, password) VALUES ('$username', SHA('$password'))";
            $dao->query($insert_query);
            echo true;
    } else {
        echo false;
    }
} else {
    //echo true;
    echo false;
}
?>