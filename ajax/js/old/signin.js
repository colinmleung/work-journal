// Progressive enhancement: PHP functionality self-contained and working
/* JS functionality has several steps:
 * 1. make sure the inputs (username and password) exist
 * 2. make sure the input combination is correct
 * 3. if correct, direct to application page
 *    if incorrect, send error message
 */

function validateForm(e) {
	'use strict';
	
	if (typeof e == 'undefined') e = window.event;
	
	var username = U.$('username');
	var password = U.$('password');
	
	var error = false;
	
	// If username and password are not entered at all, print an error message
	if (username.value.length > 0) {
		removeErrorMessage('username');
	} else {
		addErrorMessage('username', 'Please enter a username.');
		error = true;
	}
	
	if (password.value.length > 0) {
		removeErrorMessage('password');
	} else {
		addErrorMessage('password', 'Please enter a password.');
		error = true;
	}
	
	// If username and password are incorrect, print an error message
	
	// If an error is encountered, don't send the form
	
	if (error) {
		if (e.preventDefault) {
			e.preventDefault();
		} else {
			e.returnValue = false;
		}
		return false;
	}
	
	if ((username.value.length > 0) && (password.value.length > 0)) {
		var ajax = getXMLHttpRequestObject();
		ajax.onreadystatechange = function() {
			if (ajax.readyState == 4) {
				if ((ajax.status >= 200 && ajax.status < 300) || (ajax.state == 304)) {
					document.getElementById('signinForm').innerHTML = ajax.responseText;
				} else {
					document.getElementById('signinForm').submit();
				}
			}
		};
		ajax.open('POST', 'signin.php', true);
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		var data = 'username=' + encodeURIComponent(username.value) + '&password=' + encodeURIComponent(password.value);
		ajax.send(data);
		return false;
	}
}

window.onload = function() {
	'use strict';
	U.addEvent(U.$('signinForm'), 'submit', validateForm);
}