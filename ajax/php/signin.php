<?php
/**
 * signin.php
 *
 * PHP Version 5. AJAX script to sign in a user. Called by function signInAttempt in signUpModel.js.
 *
 * PHP Version 5
 * 
 * @category Workjournal
 * @package  Workjournalpackage
 * @author   Colin M. Leung <colinmleung@gmail.com>
 * @license  http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * Version   0.0.5
 */

require_once __DIR__.'/../../models/page_models/SignInModel.php';

session_start();

$sim = new SignInModel;
if ($sim->signIn($_POST['username'], $_POST['password'])) {
    echo true;
} else {
    echo false;
}
?>