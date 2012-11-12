<?php
/**
 * Contains the TemplatesModel class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Include the base class of the TemplatesModel class. */
require_once('Model.php');

/** Include the persistence layer. */
require_once('PersistenceLayer.php');

/** Include the input validator for the TemplatesModel class. */
require_once('TemplatesInputValidator.php');

/**
 * The Model class for templates.php.
 * 
 * TemplatesModel takes orders from TemplatesController, and translates them into
 * actions for the PersistenceLayer. 
 * The TemplatesModel exposes the correct model to the TemplatesView.
 * It also acts as a gatekeeper for input passed on from the TemplatesController.
 */
class TemplatesModel extends Model {

/**
 * Error message for the TemplatesModel.
 *
 * The error message is passed as a reference into the rest of the model, and any errors
 * that occur are proprogated so the TemplatesView can display it to the user.
 *
 * @var string
*/
	private $error_msg;
	
/**
 * Input Validator for the TemplatesModel. 
 *
 * The input validator filters input acquired from the controller. They also pass error messages to the model.
 *
 * @var TemplatesInputValidator */
	private $iv;
	
/**
 * Persistence Layer for the application.
 *
 * The persistence layer handles the database, session, and cookie variables.
 * 
 * @var PersistenceLayer
*/
	private $pl;
	
/** Constructs the delegates of the class. */
	function _construct() {
		$this->iv = new TemplatesInputValidator();
		$this->pl = new PersistenceLayer();
	}
	
// Control Functions
?>