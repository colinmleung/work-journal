/**
 *            Contains the writeModel definition
 * @author    Colin M. Leung
 * @version   v0.0.5
 * @license   http://opensource.org/licenses/gpl-3.0.html
                GNU General Public License
 * @copyright Colin M. Leung 2012
 */

/*global workjournal, window, require, console, evt, response, error, date_converter */

require([
    "dojo/request",
    "dojo/dom",
	"dojo/dom-construct",
	"dojo/dom-attr",
    "dojo/_base/declare"
], function (request, dom, domConstruct, domAttr, declare) {

    "use strict";

    /**
     *           The writeModel calls AJAX scripts and responds to their results
     * @class
     * @name     workjournal.writeModel
     * @property {string} writeModel.error_msg The error message from attempts to exercise write functionality
     */
    return declare("workjournal.writeModel", null, (function () {
        /** @scope writeModel */

        /**
         *           Represents the error message from attempting to exercise write functionality
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
		 *           Deletes all the nodes that form an entry
		 * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
		 */
		function deleteEntry() {
			var entry_form_children = dom.byId('entry').childNodes[1],
                form_length = entry_form_children.length,
				i;

            for (i = 5; i < form_length; i = i + 1) {
                domConstruct.destroy(entry_form_children[5]);
            }
		}

		/**
		 *           Creates a new entry with template headers
		 * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
		 */
		function createEntry(new_entry) {
			var entry_form_children = dom.byId('entry').childNodes[1],
				i,
				header_string,
				response_string,
				index;
            // create new blocks
            for (i = 0; i < new_entry.header.length; i = i + 1) {
                header_string = "entry[header][" + i + "]";
                response_string = "entry[response][" + i + "]";
                domConstruct.create("textarea",
                                    {rows: "1",
                                    cols: "200",
                                    name: header_string,
                                    id: header_string},
                                    entry_form_children);
                domConstruct.create("textarea",
                                    {rows: "10",
                                    cols: "200",
                                    name: response_string,
                                    id: response_string},
                                    entry_form_children);
            }
            // insert the headers
            for (i = 5; i < entry_form_children.length; i = i + 2) {
                index = (i - 5) / 2;
                entry_form_children[i].innerText = new_entry.header[index];
            }
		}

		/**
		 *           Create a blank entry
		 * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
		 */
		function createBlankEntry() {
			var entry_form_children = dom.byId('entry').childNodes[1],
			    header_string = "entry[header][0]",
                response_string = "entry[response][0]";
            domConstruct.create("textarea",
                                    {rows: "1",
                                    cols: "200",
                                    name: header_string,
                                    id: header_string},
                                    entry_form_children);
            domConstruct.create("textarea",
                                    {rows: "10",
                                    cols: "200",
                                    name: response_string,
                                    id: response_string},
                                    entry_form_children);
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
		 *           Clears all the responses from the entry
		 * @private
		 * @requires module:dojo/dom
		 */
		function clearResponses() {
			var entry_form_children = dom.byId('entry').childNodes[1],
			    i;
			for (i = 6; i < entry_form_children.length; i = i + 2) {
                entry_form_children[i].innerText = "";
            }
		}

		/**
		 *           Changes the date to the input date
		 * @private
		 * @requires module:dojo/dom
		 * @param    {string} date_string The date string to be shown at the date node
		 */
		function changeDate(date_string) {
			dom.byId("date").innerText = date_string;
		}

		/**
         *           Response to the create script: wipes out old entry, displays the new one with the correct template headers
         * @private
         * @param    {string} response Contains the entry filled with the template headers
         */
        function createAttemptResponse(response) {
            deleteEntry();
            createEntry(JSON.parse(response));
			disableDeleteButton();
        }

		/**
         *           Response to the save script: enables the delete button
         * @private
         * @param    {string} response 1 if attempt successful
         */
        function saveAttemptResponse() {
			enableDeleteButton();
		}

		/**
         *           Response to the delete script: replaces the current entry with a blank one, disables the delete button
         * @private
         * @param    {string} response 1 if attempt successful
         */
        function deleteAttemptResponse() {
			deleteEntry();
			createBlankEntry();
			disableDeleteButton();
		}

		/**
         *           Response to the clear script: clears all the responses in the entry
         * @private
         * @param    {string} response 1 if attempt successful
         */
        function clearAttemptResponse() {
			clearResponses();
		}

		/**
         *           Response to the date change scripts: changes the date to reflect the new timestamp
         * @private
         * @param    {string} response Timestamp of new date
         */
        function changeDateAttemptResponse(response) {
            var timestamp = +response + 86400,
                date_string = date_converter("Y-m-d", timestamp); // response+86400 to correct for date_converter
			changeDate(date_string);
            deleteEntry();
			createBlankEntry();
            disableDeleteButton();
		}

        /**
         *           Response to an error occuring in the write scripts
         * @private
         * @param    {string} error Error message from interpreter
         */
        function writeAttemptError(error) {
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
             *           Calls the PHP AJAX script write_create.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             * @param    {string} template_name The name of the template to be created
             */
            createAttempt: function (template_name) {
                request.post("../ajax/php/write_create.php", {
                    data : {
                        template_name: template_name
                    }
                }).then(
                    createAttemptResponse,
                    writeAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script write_save.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             * @param    {string[]} entry_headers An array of entry headers
			 * @param    {string[]} entry_responses An array of entry responses
             */
            saveAttempt: function (entry_headers, entry_responses) {
                request.post("../ajax/php/write_save.php", {
                    data : {
                        entry_headers: entry_headers,
						entry_responses: entry_responses
                    }
                }).then(
                    saveAttemptResponse,
                    writeAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script write_delete.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            deleteAttempt: function () {
                request.post("../ajax/php/write_delete.php", null).then(
                    deleteAttemptResponse,
                    writeAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script write_clear.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            clearAttempt: function () {
                request.post("../ajax/php/write_clear.php", null).then(
                    clearAttemptResponse,
                    writeAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script write_forward.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            forwardAttempt: function () {
                request.post("../ajax/php/write_forward.php", null).then(
                    changeDateAttemptResponse,
                    writeAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script write_backward.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            backwardAttempt: function () {
                request.post("../ajax/php/write_backward.php", null).then(
                    changeDateAttemptResponse,
                    writeAttemptError
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