<?php
/**
 * QRO (Query Result Object)
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

 /**
 * QRO (Query Result Object)
 *
 * Acts as a facade for the mysqli object.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 */
class QRO {

    /** 
     * The actual mysqli_result object.
     *
     * @var mysqli_result
     */
	private $mysqli_result;
	
    /**
     * Constructs the object using a mysqli_result
     *
     * @param mysqli_result $mysqli_result The mysqli result object to be encapsulated
     */
	function __construct($mysqli_result) {
		$this->mysqli_result = $mysqli_result;
	}

    /**
     * Get the number of rows in the query result
     *
     * @return int The number of rows in the query result
     */
    function numRows() {
        return $this->mysqli_result->num_rows;
    }
	
    /**
     * Get the query result in array form
     *
     * @return array An array of the query results
     */
	function fetchArray() {
		return $this->mysqli_result->fetch_array(MYSQLI_BOTH);
	}
	
    /**
     * Constructs the object using a mysqli_result
     *
     * @return mixed A row of the result
     */
	function fetchRow() {
		return $this->mysqli_result->fetch_row();
	}
}
?>