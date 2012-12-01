/**
 *            Contains the main javascript for the templates page
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
     *           Collects the headers into an array
     * @requires module:dojo/dom
     */
	function collectHeaders() {
		var template_form = dom.byId('templateForm'),
			headers = [],
			i;
			
		for (i = 4; i < template_form.length - 1; i = i + 2) {
            headers[(i-4)/2] = template_form[i].innerText;
        }
		
		return headers;
	}

	/**
     *           Creates a new template
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The click event from the create button
     */
    function createAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        workjournal.templatesModel().createAttempt();
    }
	
	/**
     *           Saves the current template
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The click event from the save button
     */
    function saveAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();
		
		var name = dom.byId('templateForm')[3].innerText,
		    headers = [];
			
		headers = collectHeaders();
        headers = JSON.stringify(headers);

        workjournal.templatesModel().saveAttempt(name, headers);
    }

	/**
     *           Deletes the current template and creates a blank template
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The click event from the delete button
     */
    function deleteAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();

        workjournal.templatesModel().deleteAttempt();
    }
	
	/**
     *           Add a header to the current template
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The click event from the add header button
     */
    function addHeaderAttempt(evt) {

        evt.stopPropagation();
        evt.preventDefault();
		
		var name = dom.byId('templateForm')[3].innerText,
		    headers = [];
			
		headers = collectHeaders();
        headers = JSON.stringify(headers);

        workjournal.templatesModel().addHeaderAttempt(name, headers);
    }
	
    /**
     *           Deletes a header from the current template
     * @requires module:dojo/dom
     * @param    {MouseEvent} evt The click event from one of the delete header buttons
     */
	function deleteHeaderAttempto(evt) {

		evt.stopPropagation();
        evt.preventDefault();
		
		var name = dom.byId('templateForm')[3].innerText,
		    headers = [],
			delete_array = [],
            delete_index;
			
		headers = collectHeaders();
        headers = JSON.stringify(headers);
		
        delete_index = evt.target.id.match(/\d+/g);
        delete_array[delete_index[0]] = "Delete";

        workjournal.templatesModel().deleteHeaderAttempti(name, headers, delete_array);
	}

	/**
     *           Attaches the create, save, delete, add header, delete header event handlers to the templates page buttons
     * @requires module:dojo/ready
     * @requires module:dojo/dom
     * @requires module:dojo/on
     */
    ready(function () {
        var template_form = dom.byId('templateForm'),
			create_button = dom.byId('create'),
            save_button = dom.byId('save'),
			delete_button = dom.byId('delete'),
			add_header_button = dom.byId('add_header'),
			delete_header_button,
			i;

        on(create_button, "click", createAttempt);
        on(save_button, "click", saveAttempt);
        on(delete_button, "click", deleteAttempt);
        on(add_header_button, "click", addHeaderAttempt);

		for(i = 5; i < template_form.length - 1; i = i + 2) {
            delete_header_button = template_form[i];
			on(delete_header_button, "click", deleteHeaderAttempto);
		}
    });
});