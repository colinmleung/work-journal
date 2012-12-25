<?php
/**
 * ReadController
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
 
/** Include the base class of the ReadController class. */
require_once __DIR__.'/ControllerFactory.php';

/** Include the view of the ReadController class. */
require_once __DIR__.'/../views/ReadView.php';

/** Include the model of the ReadController class. */
require_once __DIR__.'/../models/page_models/ReadModel.php';

/**
 * ReadController
 *
 * The Controller class for read.php. ReadController reads the $_POST
 * superglobal, makes decisions on what to do, and delegates tasks to the
 * ReadModel and ReadView.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 */
class ReadController extends ControllerFactory
{

    /** Calls the ControllerFactory constructor. */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Constructs a ReadView
     * 
     * @return ReadView
     */
    protected function createView() 
    {
        return new ReadView();
    }

    /**
     * Constructs a ReadModel
     * 
     * @return ReadModel
     */
    protected function createModel() 
    {
        return new ReadModel();
    }

    /** 
     * Makes decisions based on $_POST variables, and calls class functions to
     * perform the appropriate action.
     *
     * On the read page, the user can:
     * 1. sign out
     * 2. go the write page
     * 3. go the templates page
     * 4. read today's entry
     * 5. read all the entries this week
     * 6. read all the entries this month
     * 7. read all the entries this semester
     */
    function performAction() 
    {
        if (!isset($_SESSION['user_id'])) {
            $this->_userNotLoggedIn();
        } else if (isset($_POST['signout'])) {
            $this->_signOut();
        } else if (isset($_POST['write'])) {
            $this->_write();
        } else if (isset($_POST['templates'])) {
            $this->_templates();
        } else if (isset($_POST['day'])) {
            $this->_readDay();
        } else if (isset($_POST['week'])) {
            $this->_readWeek();
        } else if (isset($_POST['month'])) {
            $this->_readMonth();
        } else if (isset($_POST['semester'])) {
            $this->_readSemester();
        } else {
            $this->_readDay();
        }
    }

    /**
     * Redirect user to sign in page if not signed in.
     */
    private function _userNotLoggedIn() {
        $this->utility->redirect('signin');
    }

    /** Sign out the user. */
    private function _signOut() 
    {
        $this->model->signOut();
        $this->utility->redirect('signin');
    }

    /** Go to the write page. */
    private function _write() 
    {
        $this->model->clearWorkspace();
        $this->utility->redirect('write');
    }

    /** Go to the templates page. */
    private function _templates() 
    {
        $this->model->clearWorkspace();
        $this->utility->redirect('templates');
    }

    /** Show today's entry. */
    private function _readDay() 
    {
        $this->model->exposeDay();
        $this->view->display($this->model);
    }

    /** Show all the entries this week. */
    private function _readWeek() 
    {
        $this->model->exposeWeek();
        $this->view->display($this->model);
    }

    /** Show all the entries this month. */
    private function _readMonth() 
    {
        $this->model->exposeMonth();
        $this->view->display($this->model);
    }

    /** Show all the entries this semester. */
    private function _readSemester() 
    {
        $this->model->exposeSemester();
        $this->view->display($this->model);
    }
}
?>