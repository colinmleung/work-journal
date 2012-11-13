<?php
/**
 * TemplatesView
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
                /TemplatesView.html
 */

require_once __DIR__.'\View.php';

/**
 * TemplatesView
 *
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html 
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /TemplatesView.html
 */
class TemplateView extends View
{

    /**
     * Displays the templates.php page.
     *
     * Exposes the TemplatesModel in the context of an html page.
     * 
     * @param TemplatesModel $model The TemplatesModel.
     * 
     * @return none
     */
    public function display($model)
    {
        ?>
        <!doctype html>
        <html lang="en">
            <head>
                <meta charset="utf-8"/>
                <title>Work Journal - Templates</title>
                <meta name="description" content="A place to think about your work.
                    Work Journal is a questionnaire creator that improves your 
                    productivity by getting you to think about the questions 
                    that really matter."/>
            </head>
            <body>
                <header>
                    <h1>Templates</h1>
                </header>
                <nav>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <input type="submit" value="Write" name="write"/>
                        <input type="submit" value="Read" name="read"/>
                        <input type="submit" value="Templates" name="templates"/>
                        <input type="submit" value="Sign Out" name="signout"/>
                    </form>
                </nav>
                <div id="journal">
                    <div id="actionBar">
                        <form name="actionBar" method="post" 
                            action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <select>
                                <option value="blank">Blank</option>
        <?php
        $template_names = $model->getTemplateNames();
        foreach ($template_names as $template_name) {
            echo '<option value="' . $template_name . '">' . 
                $template_name . '</option>';
        }
        ?>
                            </select>
                            <input type="submit" value="Create New Template" 
                                name="create"/>
                            <input type="submit" value="Save" name="save"/>
                            <input type="submit" value="Delete" name="delete"/>
                            <input type="submit" value="Clear" name="clear"/>
                        </form>
                    </div>
                    <div id="template">
                        <form name="template" method="post" 
                            action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <?php
        $template_questions = $model->getTemplateQuestions();
        for ($i = 0; $i < count($template_questions); $i++) {
            $template_question = $template_questions[$i];
            echo '<textarea form="entry" rows="1" cols="200" name="' . 
                $template_question . '">' . $template_question . '</textarea>';
            echo '<input type="submit" value="Delete" name="delete_' . 
                $template_question . '"/>' . PHP_EOL;
            echo '';
        }
        echo '<input type="submit" value="Add" name="add_question"/>';
        ?>				
                        </form>
                    </div>
                </div>
            </body>
        </html>
        <?php
    }
}
?>