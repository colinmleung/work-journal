<?php
/**
 * Contains the ReadModel class.
 *
 * @package workjournalpackage
 * @author Colin M. Leung <colinmleung@gmail.com>
 * @version 0.0.2
 */
 
/** Include the base class of the ReadModel class. */
require_once __DIR__.'/../Model.php';

/** Include the persistence layer. */
require_once __DIR__.'/../data_models/ReadPersistenceLayer.php';

/**
 * The Model class for read.php.
 * 
 * ReadModel takes orders from ReadController, and translates them into
 * actions for the PersistenceLayer. 
 * The ReadModel exposes the correct model to the ReadView.
 */
class ReadModel extends Model {

/**
 * Error message for the ReadModel.
 *
 * The error message is passed as a reference into the rest of the model, and any errors
 * that occur are proprogated so the WriteView can display it to the user.
 *
 * @var string
*/
	private $error_msg;

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
		$this->pl = new ReadPersistenceLayer();
	}
	
// Control Functions

    function signOut()
    {
        $this->pl->
    }

/**
 * Exposes today's entries.
 *
 * Exposes all the entries written today.
*/
	function exposeDay() {
        // DAY = 1
		$this->pl->setReading(1);
	}
	
/**
 * Exposes this week's entries.
 *
 * Exposes all the entries written this week.
*/
	function exposeWeek() {
		$this->pl->setReading(WEEK);
	}

/**
 * Exposes this month's entries.
 *
 * Exposes all the entries written this month.
*/
	function exposeMonth() {
		$this->pl->setReading(MONTH);
	}
	
/**
 * Exposes this semester's entries.
 *
 * Exposes all the entries written this semester.
*/
	function exposeSemester() {
		$this->pl->setReading(SEMESTER);
	}
	
// View Functions

/**
 * Gets the current reading.
 *
 * Gets the exposed entries from the model.
 *
 * @return mixed An array of exposed entries.
*/
	function getReading() {
		return $this->pl->getReading();
	}

// Error Message Functions

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