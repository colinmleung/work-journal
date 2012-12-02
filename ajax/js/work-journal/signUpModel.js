/**
 *            Contains the signUpModel definition
 * @author    Colin M. Leung
 * @version   v0.0.5
 * @license   http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * @copyright Colin M. Leung 2012
 */

/*global workjournal, window, require, console, evt, response, error */

require([
    "dojo/request",
    "dojo/dom",
    "dojo/_base/declare"
], function (request, dom, declare) {
    "use strict";

    /**
     *           The signUpModel calls AJAX scripts and responds to their results
     * @class
     * @name     workjournal.signUpModel
     * @property {string} signUpModel.error_msg The error message from sign up attempts
     */
    return declare("workjournal.signUpModel", null, (function () {
        /** @scope signUpModel */

        /**
         *           Represents the error message from sign up attempts
         * @default
         * @private
         * @type     {string}
         */
        var error_msg = "";

        /**
         *           Sets the error message
         * @private
         * @param    {string} msg The message to be set
         */
        function setErrorMsg(msg) {
            error_msg = msg;
        }

        /**
         *           Responds to the sign up attempt: goes to the sign in page if successful, if not, display an error message
         * @private
         * @requires module:dojo/dom
         * @param    {string} response 1 if the sign in attempt succeeded
         */
        function signUpAttemptResponse(response) {
            if (response === "1") {
                window.location.href = "http://localhost/work-journal/application/signin.php";
            }
            setErrorMsg("Username taken.");
            dom.byId("message").innerHTML = workjournal.signUpModel().getErrorMsg();
        }

        /**
         *           Responds to an error occuring in the sign up script
         * @private
         * @param    {string} error Error message from interpreter
         */
        function signUpAttemptError(error) {
            console.log(error);
        }

        return {
            /**
             *           Filters the input username and passwords based on length and equality
             * @public
             * @param    {string} username The username
             * @param    {string} password1 The password typed in the first box
             * @param    {string} password2 The password typed in the second box
             * @return   {string} 1 if the filter is passed
             */
            inputFilter: function (username, password1, password2) {
                if (username.length !== 0 && password1.length !== 0 && password2.length !== 0) {
                    if (password1 === password2) {
                        return "1";
                    }
                    setErrorMsg("The two passwords don't match");
                    return "0";
                }
                setErrorMsg("Enter a username and a password twice.");
                return "0";
            },

            /**
             *           Calls the PHP AJAX script signup.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             * @param    {string} username The username
             * @param    {string} password The password
             */
            signUpAttempt: function (username, password) {
                request.post("../ajax/php/signup.php", {
                    data : {
                        username: username,
                        password1: password,
                        password2: password
                    }
                }).then(
                    signUpAttemptResponse,
                    signUpAttemptError
                );
            },

            /**
             *           Gets the error message
             * @public 
             * @return   {string} The error message
             */
            getErrorMsg: function () {
                return error_msg;
            }
        };
    }()));
});