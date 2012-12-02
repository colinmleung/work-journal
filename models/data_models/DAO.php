<?php
/**
 * DAO (Database Access Object)
 *
 * PHP Version 5
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 */

require_once __DIR__.'/../../utilities/connect_vars.php';

/**
 * DAO (Database Access Object)
 *
 * PHP Version 5
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 */
class DAO {

    /** 
     * The actual mysqli object.
     *
     * @var mysqli
     */
	private $mysqli;
	
    /** Constructs the object using a mysqli connection */
	function __construct() {
		$this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	}
	
    
	function sanitizeString($string) {
		return $this->mysqli->real_escape_string(trim($string));
	}
	
	function query($query) {
		return $this->mysqli->query($query);
	}
	
	function __destruct() {
		$this->mysqli->close();
	}
}
?>