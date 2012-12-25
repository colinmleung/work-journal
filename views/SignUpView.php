<?php
/**
 * SignUpView
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
 * SignUpView
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
class SignUpView extends View
{

    /**
     * Displays the signup.php page.
     *
     * Exposes the SignUpModel in the context of an html page.
     * 
     * @param SignUpModel $model The SignUpModel.
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
                <title>Sign Up for Work Journal</title>
                <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="../bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
                <meta name="description" content="A place to think about your work. 
                    Work Journal is a questionnaire creator that improves your 
                    productivity by getting you to think about the questions 
                    that really matter."/>
                <style type="text/css">
                    .row {
                        padding-top: 100px;
                    }
                </style>
            </head>
            <body>
                <div class="row">
                    <div class="span3 offset1">
                        <h2 class="form-signin-heading">Sign Up</h2>
                        <form name="signUpForm" id="signUpForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" 
                            method="post">
                            <label for="username">Username:</label>
                            <input type="text" id="username" name="username" class="input-block-level"
                                required="required"/>
                            <label for="password1">Password:</label>
                            <input type="password" id="password1" name="password1" class="input-block-level"
                                required="required"/>
                            <label for="password2">Retype Password:</label>
                            <input type="password" id="password2" name="password2" class="input-block-level"
                                required="required"/>
                            <input type="submit" value="Sign Up" name="signup" class="btn btn-large btn-primary"/>
                        </form>
                        <form name="signInButton" 
                            action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="submit" value="Sign In" name="signin" class="btn"/>
                        </form>
                    </div>
                </div>
        <?php
        $error_msg = $model->getErrorMsg();
        if (isset($error_msg)) {
            echo '<p class="error">' . $error_msg . '</p>';
        }
        ?>
                <p id="message"></p>
                <script src="../ajax/js/dojo-toolkit/dojo/dojo.js" data-dojo-config="async: true"></script>
                <script src="../ajax/js/work-journal/signUpModel.js"></script>
                <script src="../ajax/js/work-journal/signup.js"></script>
                <script src="http://code.jquery.com/jquery-latest.js"></script>
                <script src="../bootstrap/js/bootstrap.min.js"></script>
            </body>
        </html>
        <?php
    }
}
?>