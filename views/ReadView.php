<?php
/**
 * ReadView
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
                /ReadView.html
 */

require_once __DIR__.'\View.php';

/**
 * ReadView
 *
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html 
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /ReadView.html
 */
class ReadView extends View
{

    /**
     * Displays the read.php page.
     *
     * Exposes the ReadModel in the context of an html page.
     * 
     * @param ReadModel $model The ReadModel.
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
                    <title>Work Journal - Read</title>
                    <meta name="description" content="A place to think about
                        your work. Work Journal is a questionnaire creator that 
                        improves your productivity by getting you to think about 
                        the questions that really matter."/>
                </head>
                <body>
                    <header>
                        <h1>Read</h1>
                    </header>
                    <nav>
                        <form method="post" 
                            action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <input type="submit" value="Write" name="write"/>
                            <input type="submit" value="Read" name="read"/>
                            <input type="submit" value="Templates" name="templates"/>
                            <input type="submit" value="Sign Out" name="signout"/>
                        </form>
                    </nav>
                    <div id="actionBar">
                        <form method="post" 
                            action="<?php echo $_SERVER['PHP_SELF'] ?>">
                            <input type="submit" value="Daily View" name="day"/>
                            <input type="submit" value="Weekly View" name="week"/>
                            <input type="submit" value="Monthly View" name="month"/>
                            <input type="submit" value="Semesterly View" 
                                name="semester"/>
                        </form>
                    </div>
                    <div id="journal">
                        <div id="entry">
        <?php
        $reading = $model->getReading();
        $count = count($reading);
        for ($i = 0; $i < $count; $i++) {
            $entry_headers = $reading[$i]['header'];
            $entry_responses = $reading[$i]['response'];
            $inner_count = count($entry_headers);
            for ($j = 0; $j < $inner_count; $j++) {
                $entry_header = $entry_headers[$j];
                $entry_response = $entry_responses[$j];
                echo '<p>' . $entry_header . '</p>';
                echo '<p>' . $entry_response . '</p>';
            }
            
        }
        ?>
                        </div>
                    </div>
                </body>
            </html>
        <?php
    }
}
?>