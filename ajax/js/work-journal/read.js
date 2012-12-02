/**
 *            Contains the main javascript for the read page
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
     *           Display today's entries
     * @param    {MouseEvent} evt The click event from the read day button
     */
    function readDayAttempt(evt) {
        evt.stopPropagation();
        evt.preventDefault();

        workjournal.readModel().readDayAttempt();
    }

	/**
     *           Displays last week's entries
     * @param    {MouseEvent} evt The click event from the read week button
     */
    function readWeekAttempt(evt) {
        evt.stopPropagation();
        evt.preventDefault();

        workjournal.readModel().readWeekAttempt();
    }

	/**
     *           Display last month's entries
     * @param    {MouseEvent} evt The click event from the read month button
     */
    function readMonthAttempt(evt) {
        evt.stopPropagation();
        evt.preventDefault();

        workjournal.readModel().readMonthAttempt();
    }

	/**
     *           Display last semester's entries
     * @param    {MouseEvent} evt The click event from the read semester button
     */
    function readSemesterAttempt(evt) {
        evt.stopPropagation();
        evt.preventDefault();

        workjournal.readModel().readSemesterAttempt();
    }

	/**
     *           Attaches the day, week, month, semester reading event handlers to the read page buttons
     * @requires module:dojo/ready
     * @requires module:dojo/dom
     * @requires module:dojo/on
     */
    ready(function () {
        var day_button = dom.byId('day'),
            week_button = dom.byId('week'),
			month_button = dom.byId('month'),
			semester_button = dom.byId('semester');

        on(day_button, "click", readDayAttempt);
        on(week_button, "click", readWeekAttempt);
        on(month_button, "click", readMonthAttempt);
        on(semester_button, "click", readSemesterAttempt);
    });
});