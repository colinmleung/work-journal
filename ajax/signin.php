<?php
require_once __DIR__.'\..\models\data_models\DAO.php';
require_once __DIR__.'\..\models\data_models\QRO.php';
require_once __DIR__.'\..\utilities\Utility.php';
require_once __DIR__.'\..\models\data_models\SessionHandlerFacade.php';
require_once __DIR__.'\..\models\data_models\CookieHandler.php';

if (!isset($_POST['signin'])) {
    // get the data from the response
    $username = $_POST['username'];
    $password = $_POST['password'];

    $dao = new DAO;
    $search_query = "SELECT user_id, username FROM workjournal_user WHERE username = '$username' AND password = SHA('$password')";
    $qro = new QRO($dao->query($search_query));
    if ($qro->numRows() == 1) {
        $_POST['signin'] = "submit";
        $util = new Utility();
        $sh = new SessionHandlerFacade();
        $ch = new CookieHandler();
        $row = $qro->fetchArray();
		$sh->setUserId($row['user_id']);
		$sh->setUserName($row['username']);
        $sh->setDate(date('Y-m-d'));
        $ch->setLifetime(2592000);
		$ch->setUserId($row['user_id']);
		$ch->setUserName($row['username']);
        //$util->redirect('write');
        echo true;
    } else {
        echo false;
    }
} else {
    //echo true;
    echo false;
}
?>