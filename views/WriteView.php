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
                <meta name="description" content="A place to think about your work. 
                    Work Journal is a questionnaire creator that improves your 
                    productivity by getting you to think about the questions 
                    that really matter."/>
            </head>
            <body>
                <header>
                    <h1 id="date">
        <?php
        echo $date
        ?>
                    </h1>
                </header>
                <nav>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <input type="submit" value="Write" name="write"/>
                        <input type="submit" value="Read" name="read"/>
                        <input type="submit" value="Templates" name="templates"/>
                        <input type="submit" value="Sign Out" name="signout"/>
                    </form>
                </nav>
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
                        <input type="submit" value="Create New Entry" id="create" name="create"/>
                        <input type="submit" value="Save" id="save" name="save"/>
                        <input type="submit" value="Delete" id="delete" name="delete"
        <?php
        $check = $model->checkEntryId();
        if (!($check)) {
            echo 'disabled="disabled"';
        }
        ?>
                        />
                        <input type="submit" value="Clear" id="clear" name="clear"/>
                        <input type="submit" value="Forward" id="forward" name="forward"/>
                        <input type="submit" value="Backward" id="backward" name="backward"/>
        <?php
        $entry = $model->getEntry();
        $entry_count = (count($entry, COUNT_RECURSIVE)-2)/2;
        for ($i = 0; $i < $entry_count; $i++) {
            echo '<textarea rows="1" cols="200" 
                name="entry[header]['.$i.']"
                id="entry[header]['.$i.']">'.$entry['header'][$i].'</textarea>';
            echo '<textarea rows="10" cols="200" 
                name="entry[response]['.$i.']"
                id="entry[response]['.$i.']">'.$entry['response'][$i].'</textarea>';
        }
        ?>				
                    </form>
                </div>
                <p id="message"></p>
                <script src="../ajax/js/dojo/dojo/dojo.js" data-dojo-config="async: true"></script>
                <script src="../ajax/js/date.js"></script>
                <script src="../ajax/js/write.js"></script>
            </body>
        </html>
        <?php
    }
}

?>