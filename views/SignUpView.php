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
                <meta name="description" content="A place to think about your work. 
                    Work Journal is a questionnaire creator that improves your 
                    productivity by getting you to think about the questions 
                    that really matter."/>
            </head>
            <body>
                <p>Sign Up</p>
                <form name="signUpForm" id="signUpForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" 
                    method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" 
                        required="required"/>
                    <label for="password1">Password:</label>
                    <input type="password" id="password1" name="password1" 
                        required="required"/>
                    <label for="password2">Retype Password:</label>
                    <input type="password" id="password2" name="password2" 
                        required="required"/>
                    <input type="submit" value="Sign Up" name="signup"/>
                </form>
                <form name="signInButton" 
                    action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <input type="submit" value="Sign In" name="signin"/>
                </form>
        <?php
        $error_msg = $model->getErrorMsg();
        if (isset($error_msg)) {
            echo '<p class="error">' . $error_msg . '</p>';
        }
        ?>
                <p id="message"></p>
                <script src="../ajax/js/dojo/dojo/dojo.js" data-dojo-config="async: true"></script>
                <script src="../ajax/js/signup.js"></script>
            </body>
        </html>
        <?php
    }
}
?>