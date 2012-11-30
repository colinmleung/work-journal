/**
 *            Contains the signInModule definition
 * @file      Contains the signInModule definition
 * @author    Colin M. Leung
 * @version   v0.0.5
 * @license   http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * @copyright Colin M. Leung 2012
 */


require([
    "dojo/request",
    "dojo/dom",
    "dojo/_base/declare"
], function (request, dom, declare) {

    "use strict";
    
    /**
     *           The signInModel provides sign in functionality, 
                     taking input from the DOM, and interacting
                     with AJAX PHP scripts
     * @class    signInModel
     * @module   signInModel
     * @requires module: dojo/request
     * @property {string} signInModel.error_msg The error message from sign in attempts
     */
    return declare("workjournal.signInModel", null, (function () {
        /**
         *          Represents the error message from sign in attempts
         * @default
         * @private
         * @type    {string}
         */
        var error_msg = "";
        
        /**
         *          Sets the error message
         * @method  setErrorMsg
         * @private
         * @param   {string} msg The message to be set
         * @return  {void}
         */
        function setErrorMsg(msg) {
            error_msg = msg;
        }

        /**
         *          Response to the sign in script
         * @method  signInAttemptResponse
         * @private
         * @param   {bool} response True if the sign in attempt succeeded
         * @return  {bool} True if the sign in attempt succeeded
         */
        function signInAttemptResponse(response) {
            if (response === "1") {
                return true;
            }
            setErrorMsg("Enter a valid username and password combination.");
            return false;
        }

        /**
         *          Response to an error occuring in the sign in script
         * @method  signInAttemptError
         * @private
         * @param   {string} error Error message from interpreter
         * @return  {void}
         */
        function signInAttemptError(error) {
            console.log(error);
        }

        return {
            /**
             *         Filters the input username and password based on length
             * @method inputFilter
             * @public
             * @param  {string} username The username
             * @param  {string} password The password
             * @return {bool} True if the filter is passed
             */
            inputFilter: function (username, password) {
                if (username.length !== 0 && password.length !== 0) {
                    return "1";
                }
                setErrorMsg("Enter a username and password.");
                return false;
            },

            /**
             *         Calls the PHP AJAX script signin.php, and attaches the relevant event handlers
             * @method signInAttempt
             * @public
             * @param  {string} username The username
             * @param  {string} password The password
             * @return {void}
             */
            signInAttempt: function (username, password) {
                request.post("../ajax/php/signin.php", {
                    data : {
                        username: username,
                        password: password
                    }
                }).then(function(response) {
                    if (response === "1") {
                        window.location.href = "http://localhost/work-journal/application/write.php";
                    }
                    setErrorMsg("Enter a valid username and password combination.");
                    dom.byId("message").innerHTML = workjournal.signInModel().getErrorMsg();
                });
            },

            /**
             *         Gets the error message
             * @method getErrorMsg
             * @public 
             * @return {string} The error message
             */
            getErrorMsg: function () {
                return error_msg;
            }
        };
    })());
});