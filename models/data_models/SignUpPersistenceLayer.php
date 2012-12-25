<?php
require_once __DIR__.'/PersistenceLayer.php';

class SignUpPersistenceLayer extends PersistenceLayer
{
    function insertUser($username, $password, &$error_msg) {
        $search_query = "SELECT user_id FROM workjournal_user WHERE username = '$username'";
        $qro = new QRO($this->dao->query($search_query));
        // USER_EXISTS = 1
        if ($qro->numRows() != 1) {
            $insert_query = "INSERT INTO workjournal_user (username, password) VALUES ('$username', SHA('$password'))";
            $this->dao->query($insert_query);
            return true;
        } else {
            $error_msg = 'Username taken.';
            return false;
        }
    }
}
?>