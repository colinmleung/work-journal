/*global window, require, console, evt, response, error */

require([ 
    "dojo/ready",
    "dojo/dom",
    "dojo/on"
], function (ready, dom, on) {

    "use strict";

    function signInAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        var username = dom.byId("username").value,
            password = dom.byId("password").value;
            
        if (workjournal.signInModel().inputFilter(username, password)) {
                workjournal.signInModel().signInAttempt(username, password);
        }
        dom.byId("message").innerHTML = workjournal.signInModel().getErrorMsg();
    }

    ready(function () {
        var sign_in_form = dom.byId('signinForm');
        on(sign_in_form, "submit", signInAttempt);
    });
});