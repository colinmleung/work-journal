<?php
/**
 * WriteController
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
 
/** Include the base class of the WriteController class. */
require_once __DIR__.'/ControllerFactory.php';

/** Include the view of the WriteController class. */
require_once __DIR__.'/../views/WriteView.php';

/** Include the model of the WriteController class. */
require_once __DIR__.'/../models/page_models/WriteModel.php';

/**
 * WriteController
 *
 * The Controller class for write.php. WriteController reads the $_POST
 * superglobal, makes decisions on what to do, and delegates tasks to the
 * WriteModel and WriteView.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 */
class WriteController extends ControllerFactory
{

    /** Calls the ControllerFactory constructor. */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Constructs a WriteView
     * 
     * @return WriteView
     */
    protected function createView()
    {
        return new WriteView();
    }

    /**
     * Constructs a WriteModel
     * 
     * @return WriteModel
     */
    protected function createModel()
    {
        return new WriteModel();
    }

    /** 
     * Makes decisions based on $_POST variables, and calls class functions to
     * perform the appropriate action.
     *
     * On the write page, the user can:
     * - sign out
     * - go the read page
     * - go the templates page
     * - create a new entry
     * - save the current entry
     * - delete the current entry
     * - clear the current entry
     * - go to the next day
     * - go the previous day
    */
    function performAction()
    {
        if (!isset($_SESSION['user_id'])) {
            $this->_userNotLoggedIn();
        } else if (isset($_POST['signout'])) {
            $this->_signOut();
        } else if (isset($_POST['read'])) {
            $this->_read();
        } else if (isset($_POST['templates'])) {
            $this->_templates();
        } else if (isset($_POST['create'])) {
            $this->_createNewEntry();
        } else if (isset($_POST['save'])) {
            $this->_saveEntry();
        } else if (isset($_POST['delete'])) {
            $this->_deleteEntry();
        } else if (isset($_POST['clear'])) {
            $this->_clearEntry();
        } else if (isset($_POST['forward'])) {
            $this->_incrementDate();
        } else if (isset($_POST['backward'])) {
            $this->_decrementDate();
        } else {
            $this->_showDefaultEntry();
        }
    }

    /** Redirect user to sign in page if not signed in. */
    private function _userNotLoggedIn() {
        $this->utility->redirect('signin');
    }
    
    /** Sign out the user. */
    private function _signOut()
    {
        $this->model->signOut();
        $this->utility->redirect('signin');
        /*if (isset($_SESSION['user_id'])) {
            echo "its set";} else { echo "not set";}*/
    }

    /** Go to the read page. */
    private function _read()
    {
        $this->model->clearWorkspace();
        $this->utility->redirect('read');
    }

    /** Go to the templates page. */
    private function _templates()
    {
        $this->model->clearWorkspace();
        $this->utility->redirect('templates');
    }

    /** Create a new journal entry. */
    private function _createNewEntry()
    {
        $this->model->createNewEntry($_POST['template_name']);
        $this->view->display($this->model);
    }

    /** Save the current entry. */
    private function _saveEntry()
    {
        $this->model->saveEntry($_POST['entry']);
        $this->view->display($this->model);
    }

    /** Delete the current entry. */
    private function _deleteEntry()
    {
        $this->model->deleteEntry();
        $this->view->display($this->model);
    }

    /** Clear the current entry. */
    private function _clearEntry()
    {
        $this->model->clearEntry();
        $this->view->display($this->model);
    }

    /** Show the default blank entry. */
    private function _showDefaultEntry()
    {
        $this->model->showDefaultEntry();
        $this->view->display($this->model);
    }

    /** Go to the next day's entry. */
    private function _incrementDate()
    {
        $this->model->incrementDate();
        $this->view->display($this->model);
    }

    /** Go to the previous day's entry. */
    private function _decrementDate()
    {
        $this->model->decrementDate();
        $this->view->display($this->model);
    }
}
?>