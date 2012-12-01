/**
 *            Contains the main javascript for the sign in page
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
     *           Verifies the input username and password through an input filter,
                     and attempts to find the user in the database
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The submit event from the sign in form
     */
    function signInAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        var username = dom.byId("username").value,
            password = dom.byId("password").value;

        if (workjournal.signInModel().inputFilter(username, password) === "1") {
            workjournal.signInModel().signInAttempt(username, password);
        }
        dom.byId("message").innerHTML = workjournal.signInModel().getErrorMsg();
    }

    /**
     *           Attaches the sign in event handler to the sign in button
     * @requires module:dojo/ready
     * @requires module:dojo/dom
     * @requires module:dojo/on
     */
    ready(function () {
        var sign_in_form = dom.byId('signinForm');
        on(sign_in_form, "submit", signInAttempt);
    });
});