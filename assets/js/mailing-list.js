
// Load Events Listeners
Event.observe(window, 'load', init, false);

function init(){
	Event.observe('contact-form','submit',storeAddress);
}

// AJAX call sending sign up info to store-address.php
function storeAddress(event) {
	// Update user interface
	$('response').innerHTML = '<p class="warning">Saving your info...</p>';
	// Prepare query string and send AJAX request
	// NOTE: You'll need to define what info your list will accept in your MailChimp account in 
	// Lists > click the desired list > list settings > Merge tags for personalization 
	var pars = 'ajax=true&email=' + escape($F('email')) + '&sname=' + escape($F('sname'));
	var myAjax = new Ajax.Updater('response', '/assets/inc/store-address.php', {method: 'get', parameters: pars});
	Event.stop(event); // Stop form from submitting when JS is enabled
}
