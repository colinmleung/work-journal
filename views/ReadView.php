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

require_once __DIR__.'/View.php';

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
                    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
                    <meta name="description" content="A place to think about
                        your work. Work Journal is a questionnaire creator that 
                        improves your productivity by getting you to think about 
                        the questions that really matter."/>
                </head>
                <body>
                    <div class="row">
                        <div class="span12 offset1">
                            <header>
                                <h2>Read</h2>
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
                            <div id="actionBar">
                                <form method="post" 
                                    action="<?php echo $_SERVER['PHP_SELF'] ?>" id="read_form">
                                    <div class="btn-group">
                                        <input type="submit" value="Daily View" id="day" name="day" class="btn"/>
                                        <input type="submit" value="Weekly View" id="week" name="week" class="btn"/>
                                        <input type="submit" value="Monthly View" id="month" name="month" class="btn"/>
                                        <input type="submit" value="Semesterly View" id="semester" class="btn"
                                        name="semester"/>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="span12 offset1">
                            <div id="journal">
                                <div id="reading">
        <?php
        $reading = $model->getReading();
        $count = count($reading);
        for ($i = 0; $i < $count; $i++) {
            $date = $reading[$i]['date'];
            echo '<p>' . $date . '<p>';
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
                        </div>
                    </div>
                    <script src="../ajax/js/dojo-toolkit/dojo/dojo.js" data-dojo-config="async: true"></script>
                    <script src="../ajax/js/work-journal/readModel.js"></script>
                    <script src="../ajax/js/work-journal/read.js"></script>
                    <script src="http://code.jquery.com/jquery-latest.js"></script>
                    <script src="../bootstrap/js/bootstrap.min.js"></script>
                </body>
            </html>
        <?php
    }
}
?>