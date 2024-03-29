/**

	@name: Cookie class
	@description: work with cookie from javascript

*/

var cookie = {
	// set new cookie
	set: function(name, value, days) {	
		if (days) {			
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			var expires = "; expires=" + date.toGMTString();
		} else
			var expires = "";			
		document.cookie = name + "=" + value + expires + "; path=/";	
	}, 
	// get setup cookie
	get: function(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i = 0; i < ca.length; i++) {
			var c = ca[i];			
			while (c.charAt(0) == ' ')
				c = c.substring(1,c.length);			
			if (c.indexOf(nameEQ) == 0)
				return c.substring(nameEQ.length,c.length);
		}
		return "";
	}, 
	// delete sets cookie
	kill: function(name) {
		cookie.set(name, "", -1);
	}
}