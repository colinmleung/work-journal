<?php
/**
 * SignUpController
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
                /SignUpController.html
 */
 
/** Include the base class of the SignUpController class. */
require_once __DIR__.'\ControllerFactory.php';

/** Include the view of the SignUpController class. */
require_once __DIR__.'\..\views\SignUpView.php';

/** Include the model of the SignUpController class. */
require_once __DIR__.'\..\models\page_models\SignUpModel.php';

/**
 * SignUpController
 *
 * The Controller class for signup.php. SignUpController reads the $_POST
 * superglobal, makes decisions on what to do, and delegates tasks to the
 * SignUpModel and SignUpView.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /SignUpController.html
 */
class SignUpController extends ControllerFactory
{

    /** Calls the ControllerFactory constructor. */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Constructs a SignUpView
     * 
     * @return SignUpView
     */
    protected function createView()
    {
        return new SignUpView();
    }

    /**
     * Constructs a SignUpModel
     * 
     * @return SignUpModel
     */
    protected function createModel()
    {
        return new SignUpModel();
    }

    /** 
     * Makes decisions based on $_POST variables, and calls class functions to
     * perform the appropriate action.
     *
     * On the sign up page, the user can:
     * 1. sign up
     * 2. go the sign in page
     * 3. be already logged in
     *
     * @return void
     */
    public function performAction()
    {
        if (isset($_SESSION['user_id'])) {
            $this->_userLoggedIn();
        } else if (isset($_POST['signin'])) {
            $this->_signInPageRequested();
        } else if (isset($_POST['signup'])) {
            $this->_signUpRequested();
        } else {
            $this->_noActionTaken();
        }
    }

    /**
     * Just display the page.
     *
     * @return void
     */
    private function _noActionTaken()
    {
        $this->view->display($this->model);
    }

    /**
     * Attempt to sign the user up.
     *
     * @return void
     */
    private function _signUpRequested()
    {
        if ($this->model->signUp(
            $_POST['username'],
            $_POST['password1'], 
            $_POST['password2']
        )) {
            $this->utility->redirect('signin');
        }
        $this->view->display($this->model);
    }

    /**
     * Go to the sign in page.
     *
     * @return void
     */
    private function _signInPageRequested()
    {
        $this->utility->redirect('signin');
    }

    /**
     * Go to the journal page
     *
     * @return void
     */
    private function _userLoggedIn()
    {
        $this->utility->redirect('write');
    }
}
?>