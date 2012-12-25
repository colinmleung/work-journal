/**
 *            Contains the templatesModel definition
 * @author    Colin M. Leung
 * @version   v0.0.5
 * @license   http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * @copyright Colin M. Leung 2012
 */

/*global workjournal, window, require, console, evt, response, error */

require([
    "dojo/request",
    "dojo/on",
    "dojo/dom",
	"dojo/dom-construct",
    "dojo/dom-attr",
    "dojo/_base/declare"
], function (request, on, dom, domConstruct, domAttr, declare) {
	"use strict";

	/**
     *           The templatesModel calls AJAX scripts and responds to their results
     * @class
     * @name     workjournal.templatesModel
     * @property {string} templatesModel.error_msg The error message from attempts to exercise templates functionality
     */
    return declare("workjournal.templatesModel", null, (function () {
        /** @scope templatesModel */

        /**
         *           Represents the error message from attempting to exercise templates functionality
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
         *           Collects the headers into an array
         * @requires module:dojo/dom
         */
        function collectHeaders() {
            var template_form = dom.byId('templateForm'),
                headers = [],
                i;

            for (i = 4; i < template_form.length - 1; i = i + 2) {
                headers[(i - 4) / 2] = template_form[i].innerText;
            }

            return headers;
        }

        /**
		 *           Disables the delete button
		 * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-attr
		 */
		function disableDeleteButton() {
			var delete_button = dom.byId('delete');
            domAttr.set(delete_button, "disabled", "disabled");
		}

		/**
		 *           Enables the delete button
		 * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-attr
		 */
		function enableDeleteButton() {
			var delete_button = dom.byId('delete');
			domAttr.remove(delete_button, "disabled");
		}

        /**
		 *           Erases the current entry
		 * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
		 */
		function eraseEntry() {
            var template_form = dom.byId('templateForm'),
                first_header = dom.byId('template[header][0]'),
                template_name = dom.byId('template[name]'),
                i;

            // delete extra text areas
            for (i = template_form.length - 2; i > 4; i = i - 1) {
                domConstruct.destroy(template_form[i]);
            }

            // empty out the first header and response
            first_header.innerText = "";
            template_name.innerText = "";
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
            delete_array = JSON.stringify(delete_array);

            workjournal.templatesModel().deleteHeaderAttempti(name, headers, delete_array);
        }

		/**
         *           Response to the create attempt: dumps the current template and displays a new blank template
         * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
         */
        function createAttemptResponse() {
            eraseEntry();
            disableDeleteButton();
        }

        /**
         *           Response to the save attempt: enable the delete button
         * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
         */
        function saveAttemptResponse() {
            enableDeleteButton();
        }

        /**
         *           Response to the delete attempt: dumps the current template and displays a new blank template
         * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
         */
        function deleteAttemptResponse() {
            eraseEntry();
            disableDeleteButton();
        }

        /**
         *           Response to the add header attempt: creates a new header
         * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
         */
        function addHeaderAttemptResponse(response) {
            var header_array = JSON.parse(response),
                header_string,
                delete_string,
                add_header_button = dom.byId('add_header'),
                delete_header_button;

            // if only one header, create a delete button for the first header once a second one is added 
            if (header_array.length === 1) {
                delete_string = "delete_header[0]";
                domConstruct.create("input",
                                        {type: "submit",
                                        value: "Delete",
                                        name: delete_string,
                                        id: delete_string},
                                        add_header_button,
                                        "before");
                delete_header_button = dom.byId(delete_string);
                domAttr.set(delete_header_button, "class", "btn");
            }

            // insert a new header before the Add button
            header_string = "template[header][" + header_array.length + "]";
            domConstruct.create("textarea",
                                    {rows: "1",
                                    cols: "200",
                                    name: header_string,
                                    id: header_string},
                                    add_header_button,
                                    "before");

            // insert a new delete button before the Add button
            delete_string = "delete_header[" + header_array.length + "]";
            domConstruct.create("input",
                                    {type: "submit",
                                    value: "Delete",
                                    name: delete_string,
                                    id: delete_string},
                                    add_header_button,
                                    "before");

            delete_header_button = dom.byId(delete_string);
            domAttr.set(delete_header_button, "class", "btn");
            on(delete_header_button, "click", deleteHeaderAttempto);
        }

        /**
         *           Response to the delete header attempt: destroys the selected header
         * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
         */
        function deleteHeaderAttemptResponse(response) {

            var k,
                delete_array = JSON.parse(response),
                header_id_string = "template[header][" + delete_array.indexOf("Delete") + "]",
                delete_button_id = "delete_header[" + delete_array.indexOf("Delete") + "]",
                template_form = dom.byId('templateForm'),
                k_plus_one,
                new_index,
                old_header,
                old_delete,
                new_header_string,
                new_delete_string;

            // delete the header and its delete button
            domConstruct.destroy(header_id_string);
            domConstruct.destroy(delete_button_id);

            // rename all the header and delete buttons
            for (k = 4; k < template_form.length - 1; k = k + 2) {
                k_plus_one = +k + 1;
                old_header = template_form[k];
                old_delete = template_form[k_plus_one];

                new_index = (+k - 4) / 2;
                new_header_string = "template[header][" + new_index + "]";
                new_delete_string = "delete_header[" + new_index + "]";
                domAttr.set(old_header, "name", new_header_string);
                domAttr.set(old_header, "id", new_header_string);
                domAttr.set(old_delete, "name", new_delete_string);
                domAttr.set(old_delete, "id", new_delete_string);
            }

            // if only one header is left, delete its delete button
            if (delete_array.length === 1) {
                domConstruct.destroy("delete_header[0]");
            }
        }

		/**
         *           Response to an error occuring in the templates scripts
         * @private
         * @param    {string} error Error message from interpreter
         */
        function templatesAttemptError(error) {
            console.log(error);
        }

		return {
			/**
             *           Calls the PHP AJAX script templates_create.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            createAttempt: function () {
                request.post("../ajax/php/templates_create.php", null).then(
                    createAttemptResponse,
                    templatesAttemptError
                );
            },

            /**
             *           Calls the PHP AJAX script templates_save.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            saveAttempt: function (name, headers) {
                request.post("../ajax/php/templates_save.php", {
                    data: {
                        name: name,
                        headers: headers
                    }
                }).then(
                    saveAttemptResponse,
                    templatesAttemptError
                );
            },

            /**
             *           Calls the PHP AJAX script templates_delete.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            deleteAttempt: function () {
                request.post("../ajax/php/templates_delete.php", null).then(
                    deleteAttemptResponse,
                    templatesAttemptError
                );
            },

            /**
             *           Calls the PHP AJAX script templates_add_header.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            addHeaderAttempt: function (name, headers) {
                request.post("../ajax/php/templates_add_header.php", {
                    data: {
                        name: name,
                        headers: headers
                    }
                }).then(
                    addHeaderAttemptResponse,
                    templatesAttemptError
                );
            },

            /**
             *           Calls the PHP AJAX script templates_delete_header.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            deleteHeaderAttempti: function (name, headers, delete_array) {
                request.post("../ajax/php/templates_delete_header.php", {
                    data: {
                        name: name,
                        headers: headers,
                        delete_array: delete_array
                    }
                }).then(
                    deleteHeaderAttemptResponse,
                    templatesAttemptError
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