<?php
/**
 * CookieHandler
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
                /CookieHandler.html
 */

 require_once __DIR__.'/../Model.php';
 
/**
 * CookieHandler
 *
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html 
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /CookieHandler.html
 */
class CookieHandler extends Model
{

    /** @var int Number of seconds a cookie should live for */
    private $cookie_lifetime;

    /**
     * Set the cookie lifetime
     * 
     * @return void
     */
    function setLifetime($seconds)
    {
        $this->cookie_lifetime = $seconds;
    }

    /**
     * Set the user id
     * 
     * @return void
     */
    function setUserId($user_id)
    {
        setcookie('user_id', $user_id, time() + $this->cookie_lifetime);
    }

    /**
     * Get the user id
     * 
     * @return string The user id
     */
    function getUserId()
    {
        return $_COOKIE['user_id'];
    }
    
    function deleteUserId()
    {
        setcookie('user_id', $user_id, time() - 1);
    }

    /**
     * Set the username
     *
     * @return void
     */
    function setUserName($username)
    {
        setcookie('username', $username, time() + $this->cookie_lifetime);
    }

    /**
     * Get the username
     *
     * @return string The username
     */
    function getUserName() {
        return $_COOKIE['username'];
    }
    
    function deleteUserName()
    {
        setcookie('username', $username, time() - 1);
    }

    /**
     * Set the date
     *
     * @return void
     */
    function setCurrentDate($cur_date)
    {
        setcookie('cur_date', $cur_date, time() + $this->cookie_lifetime);
    }

    /**
     * Get the date
     *
     * @return string The date
     */
    function getCurrentDate()
    {
        return $_COOKIE['cur_date'];
    }
    
    function deleteCurrentDate()
    {
        setcookie('cur_date', $cur_date, time() - 1);
    }
}
?>