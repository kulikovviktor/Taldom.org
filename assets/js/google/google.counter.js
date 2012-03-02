var goog = {
	
	record: {
		
		timeoutredirect: true,
		
		timeout: 100,
		
		logs: false,
		
		trim: function(input_str) {
			input_str = input_str.replace( /^\s+/g, '');
			return input_str.replace( /\s+$/g, '');	
		},
		
		// time - integer 
		// usetimeout - boolean
		params: function (arr) {
			if (typeof arr.timeout != 'undefined') 
			this.timeout = arr.timeout;
			
			if (typeof arr.use_timeout_redirect != 'undefined') 
			this.timeoutredirect = arr.use_timeout_redirect;
			
			if (typeof arr.use_log != 'undefined') 
			this.logs = arr.use_log;
			
			return this;
		},
		
		set: function (category, link, event, lable) {
			try {
				category = this.trim(category);
				link = this.trim(link);
				event = this.trim(event);
				lable = this.trim(lable);
				if (goog.record.logs) {
					console.log('=== CLICK: START ===');
					console.log('### params of execute:');
					console.log('record.timeout: ' + this.timeout);
					console.log('record.logs: ' + this.logs);
					console.log('record.timeoutredirect: ' + this.timeoutredirect);
					console.log('### click result:');
					console.log('category: ' + category);
					console.log('link: ' + link);
					console.log('event: ' + event);
					console.log('lable: ' + lable);
					console.log('=== CLICK: END ===');
				}
				_gaq.push(['_trackEvent', category, event, lable]);
				if (goog.record.timeoutredirect) {
					setTimeout('document.location = "' + link + '"', goog.record.timeout);
				} else {
					return this;
				}
			}catch(err){
				console.log(err);
			}
		}
		
	}
	
}


// initializing default settings
$(function(){
	/*
	goog.record.params({
		use_log: false
	});
	*/
})

/* how to use:

$(function() {
	
	// set new parameters and execute query
	goog.record.params({
		timeout: 4000,
		use_timeout_redirect: false,
		use_log: true
	}).set('test_category', '/index/', 'test', 'label');
	
	// or if only set parameters 	
	goog.record.params({
		timeout: 4000,
		use_timeout_redirect: false,
		use_log: true
	});
	
	// or if only execute 
	goog.record.set('test_category', '/index/', 'test', 'label');
	
})

*/