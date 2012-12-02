/**
 *            Contains the readModel definition
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
	"dojo/dom-construct",
    "dojo/_base/declare"
], function (request, dom, domConstruct, declare) {
	"use strict";

	/**
     *           The readModel calls AJAX scripts and responds to their results
     * @class
     * @name     workjournal.readModel
     * @property {string} readModel.error_msg The error message from attempting to exercise read functionality
     */
    return declare("workjournal.readModel", null, (function () {
        /** @scope readModel */

        /**
         *           Represents the error message from attempting to exercise read functionality
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
         *           Response to the read scripts: wipes out the old reading, displays the new one
         * @private
		 * @requires module:dojo/dom
		 * @requires module:dojo/dom-construct
         * @param    {string[]} response Contains the entries requested
         */
        function readAttemptResponse(response) {

			var read_area = dom.byId("reading"),
			    reading_array = JSON.parse(response),
				i,
				j,
				date,
				entry_headers,
				entry_responses;

            // wipe out the old reading
            domConstruct.empty(read_area);

            // iterate through the response, create new paragraphs, and fill them with the entries
            for (i = 0; i < reading_array.length; i = i + 1) {
                if (reading_array[i] !== null) {

                    // create the date node
                    date = reading_array[i].date;
                    domConstruct.create("p",
                                        null,
                                        read_area);
                    read_area.lastElementChild.innerText = date;

                    // create the header and response nodes
                    entry_headers = reading_array[i].header;
                    entry_responses = reading_array[i].response;
                    for (j = 0; j < entry_headers.length; j = j + 1) {
                        domConstruct.create("p",
                                            null,
                                           read_area);
                        read_area.lastElementChild.innerText = entry_headers[j];
                        domConstruct.create("p",
                                            null,
                                           read_area);
                        read_area.lastElementChild.innerText = entry_responses[j];
                    }
                }
            }
        }

		/**
         *           Response to an error occurring in the read scripts
         * @private
         * @param    {string} error Error message from interpreter
         */
        function readAttemptError(error) {
            console.log(error);
        }

		return {
			/**
             *           Calls the PHP AJAX script read_day.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            readDayAttempt: function () {
                request.post("../ajax/php/read_day.php", null).then(
                    readAttemptResponse,
                    readAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script read_week.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            readWeekAttempt: function () {
                request.post("../ajax/php/read_week.php", null).then(
                    readAttemptResponse,
                    readAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script read_month.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            readMonthAttempt: function () {
                request.post("../ajax/php/read_month.php", null).then(
                    readAttemptResponse,
                    readAttemptError
                );
            },

			/**
             *           Calls the PHP AJAX script read_semester.php, and attaches the relevant event handlers
             * @public
             * @requires module:dojo/request
             */
            readSemesterAttempt: function () {
                request.post("../ajax/php/read_semester.php", null).then(
                    readAttemptResponse,
                    readAttemptError
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