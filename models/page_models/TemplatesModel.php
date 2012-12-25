<?php
/**
 * Contains the TemplatesModel class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Include the base class of the TemplatesModel class. */
require_once __DIR__.'/../Model.php';

/** Include the persistence layer. */
require_once __DIR__.'/../data_models/TemplatesPersistenceLayer.php';

/** Include the input validator for the TemplatesModel class. */
require_once __DIR__.'/helper_models/TemplatesInputValidator.php';

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
	function __construct()
    {
		$this->iv = new TemplatesInputValidator();
		$this->pl = new TemplatesPersistenceLayer();
	}
	
// Control Functions

    function signOut() {
        $this->pl->signOut();
    }

    function createNewTemplate()
    {
        $template = $this->pl->createNewTemplate();
        $this->pl->setWorkingTemplate($template);
    }
    
    function saveTemplate($template)
    {
        $this->pl->setWorkingTemplate($template);
		if ($this->iv->templatesFilter($template, $this->error_msg)) {
			$this->pl->insertTemplate($template, $this->error_msg);
		}
	}
    
    function deleteTemplate()
    {
        $this->pl->deleteTemplate();
        $this->createNewTemplate();
    }
    
    function deleteTemplateHeader($delete_array, $template)
    {
        $this->pl->deleteTemplateHeader($delete_array, $template);
    }
    
    function addTemplateHeader($template)
    {
        $this->pl->addTemplateHeader($template);
    }
    
    function clearWorkspace()
    {
        $this->pl->clearWorkspace();
    }

// View Functions

    function getTemplateNames()
    {
        $this->pl->getTemplateNames();
    }
    
    function getWorkingTemplate()
    {
        return $this->pl->getWorkingTemplate();
    }
    
    function checkTemplateId()
    {
        return $this->pl->checkTemplateId();
    }
    function getErrorMsg()
    {
        return $this->error_msg;
    }
    
}
?>