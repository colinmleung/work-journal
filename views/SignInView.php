<?php
/**
 * SignInView
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
                /SignUpView.html
 */

require_once __DIR__.'/View.php';

/**
 * SignInView
 *
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html 
                GNU General Public License
 * Version   0.0.2
 * @link     file://localhost/C:/xampp/htdocs/work-journal/docs/classes
                /SignInView.html
 */
class SignInView extends View
{

    /**
     * Displays the signin.php page.
     *
     * Exposes the SignInModel in the context of an html page.
     * 
     * @param SignInModel $model The SignInModel.
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
                <title>Work Journal - Record and reflect on your work</title>
                <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
                <meta name="description" content="A place to think about your work. 
                Work Journal is a questionnaire creator that improves your
                productivity by getting you to think about the questions that 
                really matter."/>
                <style type="text/css">
                    .row {
                        padding-top: 100px;
                    }
                </style>
            </head>
            <body>
                <div class="row">
                    <div class="span7 offset1">
                        <header>
                            <h1>Work Journal</h1>
                            <p class="lead">A place to think about your work.</p>
                        </header>
                        <div id="features">
                            <dl>
                                <dt>Record</dt>
                                <dd>Preserve your thoughts and feelings right when they 
                                    happen.</dd>
                                <dt>Reflect</dt>
                                <dd>Get a bird's-eye view of your work and identify key 
                                    issues.</dd>
                                <dt>Customize</dt>
                                <dd>Create personal templates to ask yourself those important 
                                    questions day after day.</dd>
                            </dl>
                        </div>
                        <div id="signUp">
                            <form method="link" action="signup.php">
                                <input type="submit" value="Sign Up" name="signup" class="btn">
                            </form>
                        </div>
                    </div>
                    <div class="span3 offset1">
                        <div id="logIn">
                            <form id ="signinForm" name="signinForm"
                                action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">	
                            <h2 class="form-signin-heading">Sign In</h2>                                
                                <div>
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" class="input-block-level" required="required"/>
                                </div>
                                <div>
                                    <label for="password">Password</label>
                                    <input type="password" id="password" name="password" class="input-block-level" required="required"/>
                                </div>
                                <input type="submit" value="Sign In" id="signin" name="signin" class="btn btn-large btn-primary"/>
                            </form>
        <?php
        $error_msg = $model->getErrorMsg();
        if (isset($error_msg)) {
            echo '<p class="error">' . $error_msg . '</p>';
        }
        ?>
                        </div>
                    </div>
                </div>
                <p id="message"></p>
                <script src="../ajax/js/dojo/dojo/dojo.js" data-dojo-config="async: true"></script>
                <script src="../ajax/js/signin.js"></script>
                <script src="http://code.jquery.com/jquery-latest.js"></script>
                <script src="../bootstrap/js/bootstrap.min.js"></script>
            </body>
        </html>
        <?php
    }
}
?>