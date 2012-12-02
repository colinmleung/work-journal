<?php
require_once(__DIR__.'/../Model.php');
require_once('DAO.php');
require_once('QRO.php');
require_once('SessionHandlerFacade.php');
require_once('CookieHandler.php');

// Acts as the layer interacting between the persistent data stores (db, sessions) and the higher-level models.
// Input contract: inputs should be pre-sanitized and pre-checked for errors. The only errors that will be reported are errors related to the state of the datastores themselves.
class PersistenceLayer extends Model {
	protected $dao;
	protected $sh;
	
	function __construct() {
		$this->dao = new DAO;
		$this->sh = new SessionHandlerFacade;
    }
}
?>