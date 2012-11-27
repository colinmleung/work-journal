<?php
/**
 * WriteView
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
                /WriteView.html
 */

require_once __DIR__.'/View.php';

/**
 * WriteView
 *
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html 
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /WriteView.html
 */
class WriteView extends View
{
    /**
     * Displays the write.php page.
     *
     * Exposes the WriteModel in the context of an html page.
     * 
     * @param WriteModel $model The WriteModel.
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
                <title>Work Journal -
        <?php
        $date = $model->getDate();
        echo $date;
        ?>
                </title>
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
                            <input type="submit" value="Forward" id="forward" name="forward" class="btn"/>
                            <h2 id="date">
                <?php
                echo $date
                ?>
                            </h2>
                            <input type="submit" value="Backward" id="backward" name="backward" class="btn"/>
                        </header>
                    </div>
                </div>
                <div class="row">
                    <div class="span12 offset1">
                        <nav>
                            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
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
                        <div id="entry">
                            <form name="entry" id="entry" method="post" 
                                action="<?php echo $_SERVER['PHP_SELF'] ?>">
                                <select name="template_name" id="template_name">
                                    <option value="blank">Blank</option>
        <?php
        $template_names = $model->getTemplateNames();
        //var_dump($template_names);
        if ($template_names != null) {
            foreach ($template_names as $template_name) {
                echo '<option value="' . $template_name . '">' . 
                    $template_name . '</option>';
            }
        }
        ?>
                                </select>
                                <div class="btn-group">
                                    <input type="submit" value="Create New Entry" id="create" name="create" class="btn"/>
                                    <input type="submit" value="Save" id="save" name="save" class="btn"/>
                                    <input type="submit" value="Delete" id="delete" name="delete" class="btn"
        <?php
        $check = $model->checkEntryId();
        if (!($check)) {
            echo 'disabled="disabled"';
        }
        ?>
                                    />
                                    <input type="submit" value="Clear" id="clear" name="clear" class="btn"/>
                                </div>
                            </div>
                        </div>
        <?php
        $entry = $model->getEntry();
        $entry_count = (count($entry, COUNT_RECURSIVE)-2)/2;
        for ($i = 0; $i < $entry_count; $i++) {
            echo '<div class="row">';
            echo '<div class="span12 offset1">';
            echo '<textarea rows="1" cols="200" 
                name="entry[header]['.$i.']"
                id="entry[header]['.$i.']">'.$entry['header'][$i].'</textarea>';
            echo '</div>';
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="span12 offset1">';
            echo '<textarea rows="10" cols="200" 
                name="entry[response]['.$i.']"
                id="entry[response]['.$i.']">'.$entry['response'][$i].'</textarea>';
            echo '</div>';
            echo '</div>';
        }
        ?>				
                    </form>
                </div>
                <p id="message"></p>
                <script src="../ajax/js/dojo/dojo/dojo.js" data-dojo-config="async: true"></script>
                <script src="../ajax/js/date.js"></script>
                <script src="../ajax/js/write.js"></script>
                <script src="../bootstrap/js/bootstrap.min.js"></script>
            </body>
        </html>
        <?php
    }
}

?>