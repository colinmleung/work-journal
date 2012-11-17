<?php
require_once __DIR__.'DatabaseConnectionFacade';

abstract class DataAccessObject {
    protected $dbcf;
    
    function __construct() {
        $this->$dbcf = new DatabaseConnectionFacade;
    }
}
?>