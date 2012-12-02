<?php
/**
 * signup.php
 *
 * PHP Version 5. AJAX script to sign up a user. Called by function signUpAttempt in signUpModel.js.
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

require_once __DIR__.'/../../models/page_models/SignUpModel.php';

session_start();

$sum = new SignUpModel;
if ($sum->signUp($_POST['username'], $_POST['password1'], $_POST['password2'])) {
    echo true;
} else {
    echo false;
}
?>