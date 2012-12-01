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

require_once __DIR__.'/View.php';

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
class TemplatesView extends View
{

    /**
     * Displays the templates.php page.
     *
     * Exposes the TemplatesModel in the context of an html page.
     * 
     * @param TemplatesModel $model The TemplatesModel.
     * 
     * @return void
     */
    public function display($model)
    {
        ?>
        <!doctype html>
        <html lang="en">
            <head>
                <meta charset="utf-8"/>
                <title>Work Journal - Templates</title>
                <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
                <meta name="description" content="A place to think about your work.
                    Work Journal is a questionnaire creator that improves your 
                    productivity by getting you to think about the questions 
                    that really matter."/>
            </head>
            <body>
                <div class="row">
                    <div class="span12 offset1">
                        <header>
                            <h2>Templates</h2>
                        </header>
                    </div>
                </div>
                <div class="row">
                    <div class="span12 offset1">
                        <nav>
                            <form method="post" 
                                action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                <div class="btn-group">
                                    <input type="submit" value="Write" name="write" class="btn"/>
                                    <input type="submit" value="Read" name="read" class="btn"/>
                                    <input type="submit" value="Templates" name="templates" class="btn"/>
                                </div>
                                <input type="submit" value="Sign Out" name="signout" class="btn"/>
                            </form>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="span12 offset1">
                        <div id="template">
                            <form name="template" method="post" id="templateForm"
                                action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <!--<select>
                            <option value="blank">Blank</option>
        <?php
        /*$template_names = $model->getTemplateNames();
        if ($template_names != null) {
            foreach ($template_names as $template_name) {
                echo '<option value="' . $template_name . '">' . 
                    $template_name . '</option>';
            }
        }*/
        ?>
                        </select>-->
                                <div class="btn-group">
                                    <input type="submit" value="Create New Template" id="create"
                                        name="create" class="btn"/>
                                    <input type="submit" value="Save" id="save" name="save" class="btn"/>
                                    <input type="submit" value="Delete" id="delete" name="delete" class="btn"
        <?php
        $check = $model->checkTemplateId();
        if (!($check)) {
            echo 'disabled="disabled"';
        }
        ?>
                                    />
                                </div>
                        
        <?php
        $template = $model->getWorkingTemplate();
        $template_name = $template['name'];
        $template_headers = $template['header'];
        
        echo '<textarea rows="1" cols="200" 
            id="template[name]"
            name="template[name]">' . $template_name . '</textarea>';
        $template_count = count($template_headers);
        for ($i = 0; $i < $template_count; $i++) {
            $template_header = $template_headers[$i];
            echo '<textarea rows="1" cols="200"
                id="template[header][' . $i . ']"
                name="template[header][' . $i . ']">' . $template_header . 
                    '</textarea>';
            if ($template_count > 1) {
                echo '<input type="submit" value="Delete" 
                class="btn"
                id="delete_header[' . $i . ']"
                name="delete_header[' . $i . ']"/>' . PHP_EOL;
            }
            echo '';
        }
        echo '<input type="submit" value="Add" name="add_header" class="btn" id="add_header"/>';
        ?>				
                            </form>
                        </div>
                    </div>
        <?php
        $error_msg = $model->getErrorMsg();
        if (isset($error_msg)) {
            echo '<p class="error">' . $error_msg . '</p>';
        }
        ?>
                </div>
                <script src="../ajax/js/dojo-toolkit/dojo/dojo.js" data-dojo-config="async: true"></script>
                    <script src="../ajax/js/work-journal/templatesModel.js"></script>
                    <script src="../ajax/js/work-journal/templates.js"></script>
                    <script src="http://code.jquery.com/jquery-latest.js"></script>
                    <script src="../bootstrap/js/bootstrap.min.js"></script>
            </body>
        </html>
        <?php
    }
}
?>
