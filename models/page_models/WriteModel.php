<?php
/**
 * Contains the WriteModel class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */

/** Include the base class of the WriteModel class. */
require_once __DIR__.'/../Model.php';

/** Include the persistence layer. */
require_once __DIR__.'/../data_models/WritePersistenceLayer.php';

/** Include the input validator for the WriteModel class. */
require_once __DIR__.'/helper_models/WriteInputValidator.php';

/**
 * The Model class for write.php.
 * 
 * WriteModel takes orders from WriteController, and translates them into
 * actions for the PersistenceLayer. 
 * The WriteModel exposes the correct model to the WriteView.
 * It also acts as a gatekeeper for input passed on from the WriteController.
 */
class WriteModel extends Model {

/**
 * Error message for the WriteModel.
 *
 * The error message is passed as a reference into the rest of the model, and any errors
 * that occur are proprogated so the WriteView can display it to the user.
 *
 * @var string
*/
	private $error_msg;
	
/**
 * Input Validator for the WriteModel. 
 *
 * The input validator filters input acquired from the controller. They also pass error messages to the model.
 *
 * @var WriteInputValidator */
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
	function __construct() {
		$this->iv = new WriteInputValidator();
		$this->pl = new WritePersistenceLayer();
	}
	
// Control Functions

    function signOut() {
        $this->pl->signOut();
    }
	
    /**
     * Create a new entry.
     *
     * Creates a blank entry with headers corresponding to the selected template. Set it as the working entry.
     *
     * @param string $template_name The name of the template.
     */
	function createNewEntry($template_name) {
		return $this->pl->createNewEntry($template_name);
	}
	
    /** 
     * Save the current entry.
     * 
     * Saves the current entry into the database.
     * 
     * @param mixed $entry The entry to be saved.
    */
	function saveEntry($entry) {
		if ($this->iv->writeFilter($entry, $this->error_msg)) {
			$this->pl->insertEntry($entry);
            return true;
		}
        return false;
	}
	
    /**
     * Delete the current entry.
     * 
     * Deletes the current entry from the database. A blank entry becomes the working entry.
    */
	function deleteEntry() {
		$this->pl->deleteEntry($this->error_msg);
		$this->pl->setBlankWorkingEntry();
        return true;
	}
	
    /**
     * Clear the current entry.
     *
     * Erases all the responses in current entry. Makes no changes to the database.
    */
	function clearEntry() {
		$this->pl->clearWorkingEntry();
	}
	
    /**
     * Show the default entry.
     *
     * Shows a blank entry with one empty header and one empty response.
    */
	function showDefaultEntry() {
		$this->pl->setBlankWorkingEntry();
	}
	
    /**
     * Go to the next day.
     *
     * Goes to the entries of the next day. Discards the working entry.
    */
	function incrementDate() {
		$this->pl->incrementDate();
        $this->pl->clearWorkspace();
		$this->pl->setBlankWorkingEntry();
	}
	
    /**
     * Go to the previous day.
     *
     * Goes to the entries of the previous day. Discards the working entry.
    */
	function decrementDate() {
		$this->pl->decrementDate();
        $this->pl->clearWorkspace();
		$this->pl->setBlankWorkingEntry();
	}
    
    function clearWorkspace() {
        $this->pl->clearWorkspace();
    }
	
    // View Functions

    /**
     * Get the working date.
     * 
     * Retrieve the date that the user wants to go to.
     *
     * @return mixed The working date.
    */
	function getDate() {
		return $this->pl->getDate();
	}
	
    /**
     * Get the template names.
     *
     * Get the names of the templates that exist.
     *
     * @return array An array of template names.
    */
	function getTemplateNames() {
		return $this->pl->getTemplateNames();
	}
	
    /*
     * Get the current entry.
     *
     * Gets the currently worked on entry.
     *
     * @return entry The working entry stored in the model.
    */
	function getEntry() {
		return $this->pl->retrieveWorkingEntry();
	}
	
    /*
     * Check if entry id exists.
     * 
     * Checks to see if the working entry has already been stored in the database.
     *
     * @return bool True if entry id exists.
    */
	function checkEntryId() {
		return $this->pl->checkEntryId();
	}

    /**
     * Gets the current error message.
     *
     * Gets the current error message from the model.
     *
     * @return string The model's error message.
    */
	function getErrorMsg() {
		return $this->error_msg;
	}
}
?>