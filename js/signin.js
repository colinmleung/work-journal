function init() {
	'use strict';
	if (document && document.getElementById) {
		var signinForm = document.getElementById('signinForm');
		signinForm.onsubmit = validateForm;
	}
}

function validateForm() {
	'use strict';
	var username = document.getElementById('username');
	var password = document.getElementById('password');
	
	if (username.value.length == 0) {
		document.write('Please enter a username.');
	}
	
	if (password.value.length == 0) {
		document.write('Please enter a password.');
	}
	
}

if (window.addEventListener) {
	window.addEventListener('load', init, false);
} else if (window.attachEvent) {
	window.attachEvent('onload', init);
}

if ()