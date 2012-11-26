//	Code from Modern Javascript: Develop and Design

function addErrorMessage(id, msg) {
	'use script';
	var elem = document.getElementById(id);
	var newId = id + 'Error';
	var span = document.getElementById(newId);
	if (span) {
		span.firstChild.value = msg;
	} else {
		span  = document.createElement('span');
		span.id = newId;
		span.className = 'error';
		span.appendChild(document.createTextNode(msg));
		
		elem.parentNode.appendChild(span);
		elem.previousSibling.className = 'error';
	}
}

function removeErrorMessage(id) {
	'use strict';
	
	var span = document.getElementById(id + 'Error');
	if (span) {
		span.previousSibling.previousSibling.className = null;
		span.parentNode.removeChild(span);
	}
}