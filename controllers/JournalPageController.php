<?php
/**
 * JournalPageController
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
                /JournalPageController.html
 */
 
/** Include the base class of the JournalPageController class. */
require_once __DIR__.'\ControllerFactory.php';

/** Include the view of the JournalPageController class. */
require_once __DIR__.'\..\views\JournalPageView.php';

/** Include the model of the JournalPageController class. */
require_once __DIR__.'\..\models\page_models\JournalPageModel.php';

/**
 * JournalPageController
 *
 * The Controller class for journalpage.php. JournalPageController reads the $_POST
 * superglobal, makes decisions on what to do, and delegates tasks to the
 * JournalPageModel and JournalPageView.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /JournalPageController.html
 */
class JournalPageController extends ControllerFactory
{

    /** Calls the ControllerFactory constructor. */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Constructs a JournalPageView
     * 
     * @return JournalPageView
     */
    protected function createView()
    {
        return new JournalPageView();
    }

    /**
     * Constructs a JournalPageModel
     * 
     * @return JournalPageModel
     */
    protected function createModel()
    {
        return new JournalPageModel();
    }

    /**
     * Makes decisions based on $_POST variables, and calls class functions to
     * perform the appropriate action.
     *
     * On the journal page, the user can:
     * 1. save their data
     * 2. go to the next day's entry
     * 3. go to the previous day's entry
     * 4. sign out
     *
     * @return void
    */
    public function performAction()
    {
        if (isset($_POST['save'])) {
            $this->_saveData();
        } else if (isset($_POST['forward'])) {
            $this->_incrementDay();
        } else if (isset($_POST['backward'])) {
            $this->_decrementDay();
        } else if (isset($_POST['signout'])) {
            $this->_signOut();
        } else {
            $this->_noActionTaken();
        }
    }

    /**
     * Save the current entry.
     *
     * @return void
     */
    private function _saveData()
    {
        $this->model->saveData($_POST['tasksp'], $_POST['tasksc'], $_POST['issues']);
        $this->model->getData();
        $this->view->display($this->model);
    }

    /**
     * Go to the next day's entry.
     *
     * @return void
     */
    private function _incrementDay()
    {
        $this->model->incrementDay();
        $this->model->getData();
        $this->view->display($this->model);
    }

    /**
     * Go the previous day's entry.
     *
     * @return void
     */
    private function _decrementDay()
    {
        $this->model->decrementDay();
        $this->model->getData();
        $this->view->display($this->model);
    }

    /**
     * Go to the sign in page.
     *
     * @return void
     */
    private function _signOut()
    {
        $this->model->signOut();
        $this->utility->redirect('signin');
    }

    /**
     * Just display the page.
     *
     * @return void
     */
    private function _noActionTaken()
    {
        $this->model->getData();
        $this->view->display($this->model);
    }
}
?>