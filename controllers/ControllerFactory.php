<?php
/**
 * ControllerFactory
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
                /ControllerFactory.html
 */

 
/**
 * ControllerFactory
 *
 * Abstract Factory for maintaining the MVC relationships. ControllerFactory is
 * the base class of the other controllers. Each controller must have a model,
 * a view, and a helper utility class. The models and views are dynamically
 * created at runtime based on the type of controller. The controller's has
 * 3 roles:
 * 1. Get information from $_POST
 * 2. Decide what course of action to take
 * 3. Tell the browser, model, or view what to do
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /ControllerFactory.html
 */
abstract class ControllerFactory
{

    /** 
     * View part of the MVC.
     * 
     * The View represents the part of the MVC that displays the Model to the user.
     * It grabs relevant variables from the Model.
     *
     * @var mixed
     */
    protected $view;

    /** 
     * Model part of the MVC.
     *
     * The Model represents all the logic of the application, as well as 
     * connections to the persistent data stores. 
     *
     * @var Model
     */
    protected $model;

    /** @var Utility */
    protected $utility;

    /**
     * The constructor dynamically constructs the appropriate views and models
     * as well as the utility object. 
     *
     * @return mixed
     */
    function __construct()
    {
        $this->view = $this->createView();
        $this->model = $this->createModel();
        $this->utility = new Utility();
    }
    
    /**
     * Constructs the appropriate view. 
     *
     * @return mixed
     */
    abstract protected function createView();

    /**
     * Constructs the approriate model.
     *
     * @return mixed
     */
    abstract protected function createModel();

    /** 
     * All controllers must respond to user actions and perform the approriate
     * operations.
     *
     * @return void
     */
    abstract public function performAction();
}
?>