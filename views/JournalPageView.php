<?php
/**
 * JournalPageView
 *
 * PHP Version 5
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.1
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /JournalPageView.html
 */

require_once __DIR__.'\View.php';

/**
 * JournalPageView
 *
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html 
                GNU General Public License
 * Version   0.0.1
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /JournalPageView.html
 */
class JournalPageView extends View
{

    /**
     * Displays the journalpage.php page.
     *
     * Exposes the JournalPageModel in the context of an html page.
     * 
     * @param JournalPageModel $model The JournalPageModel.
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
                <title>WorkJournal</title>
            </head>
            <body>
                <p>date = <?php echo $_SESSION['curdate'] ?></p>
                <form name="journal" 
                    action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    Tasks Planned: 
                        <textarea name="tasksp" id="tasksp" rows="3" cols="30">
                        <?php echo $model->tasksp ?></textarea>
                    Tasks Completed: 
                        <textarea name="tasksc" id="tasksc" rows="3" cols="30">
                        <?php echo $model->tasksc ?></textarea>
                    Issues: 
                        <textarea name="issues" id="issues" rows="3" cols="30">
                        <?php echo $model->issues ?></textarea>
                    <input type="submit" value="Save" name="save"/>
                    <input type="submit" value="Forward" name="forward"/>
                    <input type="submit" value="Backward" name="backward"/>
                    <input type="submit" value="Sign Out" name="signout"/>
                </form>
            </body>
        </html>
        <?php
    }
}
?>