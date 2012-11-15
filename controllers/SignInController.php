<?php
/**
 * SignInController
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
                /SignInController.html
 */
 
/** Include the base class of the SignInController class. */
require_once __DIR__.'/ControllerFactory.php';

/** Include the view of the SignInController class. */
require_once __DIR__.'/../views/SignInView.php';

/** Include the model of the SignInController class. */
require_once __DIR__.'/../models/page_models/SignInModel.php';

/**
 * SignInController
 *
 * The Controller class for signin.php. SignInController reads the $_POST
 * superglobal, makes decisions on what to do, and delegates tasks to the
 * SignInModel and SignInView.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /SignInController.html
 */
class SignInController extends ControllerFactory
{

    /** Calls the ControllerFactory constructor. */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Constructs a SignInView
     * 
     * @return SignInView
     */
    protected function createView()
    {
        return new SignInView();
    }

    /**
     * Constructs a SignInModel
     * 
     * @return SignInModel
     */
    protected function createModel()
    {
        return new SignInModel();
    }

    /** 
     * Makes decisions based on $_POST variables, and calls class functions to
     * perform the appropriate action.
     *
     * On the sign in page, the user can:
     * 1. log in
     * 2. go the sign up page
     * 3. be already logged in
     *
     * @return void
    */
    public function performAction()
    {
        if (isset($_SESSION['user_id'])) {
            $this->_userLoggedIn();
        } else if (isset($_POST['signin'])) {
            $this->_signInRequested();
        } else if (isset ($_POST['signup'])) {
            $this->_signUpPageRequested();
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
     * Attempt to log in the user.
     *
     * @return void
     */
    private function _signInRequested()
    {
        if ($this->model->signIn($_POST['username'], $_POST['password'])) {
            $this->utility->redirect('write');
        } else {
            $this->view->display($this->model);
        }
    }

    /**
     * Go to the sign up page.
     *
     * @return void
     */
    private function _signUpPageRequested()
    {
        $this->utility->redirect('signup');
    }

    /**
     * Go to the journal page.
     *
     * @return void
     */
    private function _userLoggedIn()
    {
        $this->utility->redirect('write');
    }
}
?>