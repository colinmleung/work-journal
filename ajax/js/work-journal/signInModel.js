/**
 *            Contains the signInModel definition
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
     *           The signInModel calls AJAX scripts and responds to their results
     * @class
     * @name     workjournal.signInModel
     * @property {string} signInModel.error_msg The error message from sign in attempts
     */
    return declare("workjournal.signInModel", null, (function () {
        /** @scope signInModel */

        /**
         *           Represents the error message from sign in attempts
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
         *           Response to the sign in script: goes to the write page if successful, if not, display an error message
         * @private
         * @requires module:dojo/dom
         * @param    {string} response 1 if the sign in attempt succeeded
         */
        function signInAttemptResponse(response) {
            if (response === "1") {
                window.location.href = "http://www.colinmleung.com/workjournal/ajax/application/write.php";
            }
            setErrorMsg("Enter a valid username and password combination.");
            dom.byId("message").innerHTML = workjournal.signInModel().getErrorMsg();
        }

        /**
         *           Responds to an error occurring in the sign in attempt
         * @private
         * @param    {string} error Error message from interpreter
         */
        function signInAttemptError(error) {
            console.log(error);
        }

        return {
            /**
             *           Filters the input username and password based on length
             * @public
             * @param    {string} username The username
             * @param    {string} password The password
             * @return   {string} 1 if the filter is passed
             */
            inputFilter: function (username, password) {
                if (username.length !== 0 && password.length !== 0) {
                    return "1";
                }
                setErrorMsg("Enter a username and password.");
                return "0";
            },

            /**
             *           Calls the PHP AJAX script signin.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             * @param    {string} username The username
             * @param    {string} password The password
             */
            signInAttempt: function (username, password) {
                request.post("../ajax/php/signin.php", {
                    data : {
                        username: username,
                        password: password
                    }
                }).then(
                    signInAttemptResponse,
                    signInAttemptError
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