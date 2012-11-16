<?php
/**
 * TemplatesController
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
                /TemplatesController.html
 */
 
/** Include the base class of the TemplatesController class. */
require_once __DIR__.'\ControllerFactory.php';

/** Include the view of the TemplatesController class. */
require_once __DIR__.'\..\views\TemplatesView.php';

/** Include the model of the TemplatesController class. */
require_once __DIR__.'\..\models\page_models\TemplatesModel.php';

/**
 * TemplatesController
 *
 * The Controller class for templates.php. TemplatesController reads the $_POST
 * superglobal, makes decisions on what to do, and delegates tasks to the
 * TemplatesModel and TemplatesView.
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /TemplatesController.html
 */
class TemplatesController extends ControllerFactory
{

    /** Calls the ControllerFactory constructor. */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Constructs a TemplatesView
     * 
     * @return TemplatesView
     */
    protected function createView()
    {
        return new TemplatesView();
    }

    /**
     * Constructs a TemplatesModel
     * 
     * @return TemplatesModel
     */
    protected function createModel()
    {
        return new TemplatesModel();
    }

    /** 
     * Makes decisions based on $_POST variables, and calls class functions to
     * perform the appropriate action.
     *
     * On the templates page, the user can:
     * 1. sign out
     * 2. go the write page
     * 3. go the read page
     * 4. create a new templates
     * 5. load an existing template
     * 6. save the current template
     * 7. modify the existing template
     *
     * @return void
    */
    function performAction()
    {
        if (isset($_POST['signout'])) {
            $this->_signOut();
        } else if (isset($_POST['read'])) {
            $this->_read();
        } else if (isset($_POST['write'])) {
            $this->_write();
        } else if (isset($_POST['create'])) {
            $this->_createNewTemplate();
        } else if (isset($_POST['save'])) {
            $this->_saveTemplate();
        } else if (isset($_POST['delete'])) {
            $this->_deleteTemplate();
        } else if (isset($_POST['delete_header'])) {
            if (count($_POST['delete_header']) == 1)
                $this->_deleteTemplateHeader();
        } else if (isset($_POST['add_header'])) {
            $this->_addTemplateHeader();
        } else {
            $this->_createNewTemplate();
        }
    }

    /**
     * Sign out the user.
     *
     * @return void
     */
    private function _signOut()
    {
        $this->model->signOut();
        $this->utility->redirect('signin');
    }

    /**
     * Go to the write page.
     *
     * @return void
     */
    private function _write()
    {
        $this->utility->redirect('write');
    }

    /**
     * Go to the read page.
     *
     * @return void
     */
    private function _read()
    {
        $this->utility->redirect('read');
    }

    /**
     * Create a new template.
     *
     * @return void
     */
    private function _createNewTemplate()
    {
        $this->model->createNewTemplate();
        $this->view->display($this->model);
    }

    /**
     * Save the current template.
     *
     * @return void
     */
    private function _saveTemplate()
    {
        $this->model->saveTemplate($_POST['template']);
        $this->view->display($this->model);
    }

    /**
     * Delete the current template.
     *
     * @return void
     */
    private function _deleteTemplate()
    {
        $this->model->deleteTemplate();
        $this->view->display($this->model);
    }

    /**
     * Delete a template question.
     *
     * @return void
     */
    private function _deleteTemplateHeader()
    {
        $this->model->deleteTemplateHeader($_POST['delete_header'], $_POST['template']);
        $this->view->display($this->model);
    }
    
    /**
     * Add a template question.
     *
     * @return void
     */
    private function _addTemplateHeader()
    {
        $this->model->addTemplateHeader($_POST['template']);
        $this->view->display($this->model);
    }
}
?>