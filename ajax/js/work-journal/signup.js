/**
 *            Contains the main javascript for the sign up page
 * @author    Colin M. Leung
 * @version   v0.0.5
 * @license   http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * @copyright Colin M. Leung 2012
 */

/*global workjournal, require, evt*/

require([
    "dojo/ready",
    "dojo/dom",
    "dojo/on"
], function (ready, dom, on) {

    "use strict";

    /**
     *           Verifies the input username and passwords through an input filter, and 
                     attempts to add the user to the database
     * @function signUpAttempt
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The submit event from the sign up form
     */
    function signUpAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        var username = dom.byId("username").value,
            password1 = dom.byId("password1").value,
            password2 = dom.byId("password2").value;

        if (workjournal.signUpModel().inputFilter(username, password1, password2) === "1") {
            workjournal.signUpModel().signUpAttempt(username, password1);
        }
        dom.byId("message").innerHTML = workjournal.signUpModel().getErrorMsg();
    }

    /**
     *           Attaches the sign up event handler to the sign up button
     * @function
     * @requires module:dojo/ready
     * @requires module:dojo/dom
     * @requires module:dojo/on
     */
    ready(function () {
        var sign_up_form = dom.byId('signUpForm');
        on(sign_up_form, "submit", signUpAttempt);
    });
});