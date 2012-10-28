function validateForm(e) {
	'use strict';
	
	if (typeof e == 'undefined') e = window.event;
	
	var username = U.$('username');
	var password = U.$('password');
	
	var error = false;
	
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
					if (ajax.responseText == 'VALID') {
						alert('You are logged in!');
					} else {
						alert('The submitted values do not match those on file!');
					}
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