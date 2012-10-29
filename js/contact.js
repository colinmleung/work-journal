function handleAjaxResponse(e) {
	'use strict';
	if (typeof e == 'undefined') e = window.event;
	var ajax = e.target || e.srcElement;
	if (ajax.readyState == 4) {
		if ((ajax.status >= 200 && ajax.status < 300) || (ajax.status == 304)) {
			document.getElementById('signinForm').innerHTML = ajax.responseText;
		} else { // Status error!
			document.getElementById('signinForm').submit();
		}
		ajax = null;
	}
}