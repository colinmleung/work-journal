/**
 *            Contains the main javascript for the write page
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
     *           Create a new entry with the selected template headers
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The click event from the create button
     */
    function createAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        var template_name = dom.byId("template_name").options[dom.byId("template_name").selectedIndex].text;
        workjournal.writeModel().createAttempt(template_name);
    }

    /**
     *           Saves the current entry
     * @function saveAttempt
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The click event from the save button
     */
    function saveAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        var entry_form_children = dom.byId('entry').childNodes[1],
            entry_header = [],
            entry_response = [],
			i;

        for (i = 5; i < entry_form_children.length; i = i + 1) {
            if ((i % 2) === 1) {
                entry_header[(i - 5) / 2] = entry_form_children[i].innerText;
            } else {
                entry_response[(i - 6) / 2] = entry_form_children[i].innerText;
            }
        }

        entry_header = JSON.stringify(entry_header);
        entry_response = JSON.stringify(entry_response);

        workjournal.writeModel().saveAttempt(entry_header, entry_response);
    }

    /**
     *           Deletes the current entry, and displays a new blank entry
     * @function deleteAttempt
     * @param    {MouseEvent} evt The click event from the delete button
     */
    function deleteAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        workjournal.writeModel().deleteAttempt();
    }

    /**
     *           Clears all the responses from the entry
     * @function clearAttempt
     * @param    {MouseEvent} evt The click event from the clear button
     */
    function clearAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        workjournal.writeModel().clearAttempt();
    }

    /**
     *           Move the date forward by one day
     * @function forwardAttempt
     * @param    {MouseEvent} evt The click event from the forward button
     */
    function forwardAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        workjournal.writeModel().forwardAttempt();
    }

    /**
     *           Move the date backward by one day
     * @function backwardAttempt
     * @param    {MouseEvent} evt The click event from the backward button
     */
    function backwardAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        workjournal.writeModel().backwardAttempt();
    }

    /**
     *           Attaches the create, save, delete, clear, forward, backward event handlers to the write page buttons
     * @function
     * @requires module:dojo/ready
     * @requires module:dojo/dom
     * @requires module:dojo/on
     */
    ready(function () {
        var create_button = dom.byId('create'),
            save_button = dom.byId('save'),
			delete_button = dom.byId('delete'),
			clear_button = dom.byId('clear'),
			forward_button = dom.byId('forward'),
			backward_button = dom.byId('backward');

        on(create_button, "click", createAttempt);
        on(save_button, "click", saveAttempt);
        on(delete_button, "click", deleteAttempt);
        on(clear_button, "click", clearAttempt);
        on(forward_button, "click", forwardAttempt);
        on(backward_button, "click", backwardAttempt);
    });
});