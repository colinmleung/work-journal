<?php
/**
 * SessionHandlerFacade
 *
 * PHP Version 5
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /SessionHandlerFacade.html
 */

/**
 * SessionHandlerFacade
 *
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html 
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /SessionHandlerFacade.html
 */
class SessionHandlerFacade //extends SessionHandler
{

    /**
     * Set the user id
     * 
     * @return void
     */
    function setUserId($user_id)
    {
        //parent::write('user_id', $user_id);
        $_SESSION['user_id'] = $user_id;
    }

    /**
     * Get the user id
     * 
     * @return string The user id
     */
    function getUserId()
    {
        //return parent::read('user_id');
        return $_SESSION['user_id'];
    }
    
    function deleteUserId()
    {
        $_SESSION['user_id'] = null;
    }

    /**
     * Set the username
     * 
     * @return void
     */
    function setUserName($username)
    {
        //parent::write('username', $username);
        $_SESSION['username'] = $username;
    }

    /**
     * Get the username
     * 
     * @return string The username
     */
    function getUserName()
    {
        //return parent::read('username');
        return $_SESSION['username'];
    }
    
    function deleteUserName()
    {
        $_SESSION['username'] = null;
    }

    /**
     * Set the working date
     * 
     * @return void
     */
    function setDate($date)
    {
        //parent::write('date', $date);
        $_SESSION['date'] = $date;
    }

    /**
     * Get the working date
     * 
     * @return string The date
     */
    function getDate()
    {
        //return parent::read('date');
        return $_SESSION['date'];
    }
    
    function deleteDate()
    {
        $_SESSION['date'] = null;
    }

    /**
     * Set the working entry
     * 
     * @return void
     */
    function setWorkingEntry($entry)
    {
        //parent::write('entry', $entry);
        $_SESSION['entry'] = $entry;
    }

    /**
     * Get the working entry
     * 
     * @return mixed The working entry in array form
     */
    function getWorkingEntry()
    {
        //return parent::read('entry');
        return $_SESSION['entry'];
    }

    /**
     * Set the working entry id
     * 
     * @return void
     */
    function setWorkingEntryId($entry_id)
    {
        //parent::write('entry_id', $entry_id);
        $_SESSION['entry_id'] = $entry_id;
    }

    /**
     * Get the working entry id
     * 
     * @return string The entry id
     */
    function getWorkingEntryId()
    {
        //return parent::read('entry_id');
        return $_SESSION['entry_id'];
    }

     /**
     * Set the reading
     * 
     * @return void
     */
    function setReading($reading)
    {
        //parent::write('reading', $reading);
        $_SESSION['reading'] = $reading;
    }

    /**
     * Get the reading
     * 
     * @return mixed The reading in array form
     */
    function getReading()
    {
        //return parent::read('reading');
       return $_SESSION['reading'];
    }
    
    function setWorkingTemplate($template)
    {
        $_SESSION['template'] = $template;
    }
    
    function getWorkingTemplate()
    {
        return $_SESSION['template'];
    }
}
?>