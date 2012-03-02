// flat scrolling

var flatScrolling = function(/* args */) {
	if (arguments.length > 0) {
      destination = $(arguments[0]).offset().top;
      if($.browser.safari){
        $('body').animate( { scrollTop: destination }, typeof arguments[1] == 'number' ? arguments[1] : 600 );
      }else{
        $('html').animate( { scrollTop: destination }, typeof arguments[1] == 'number' ? arguments[1] : 600 );
      }
	}
    return false;
}

// preloading function

var cache = [];
var preloadImages = function(/* args */) {
	var args_len = arguments.length;
	for (var i = args_len; i--;) {
		var cacheImage = document.createElement('img');
		cacheImage.src = arguments[i];
		cache.push(cacheImage);
	}
}

// execution function

var execfn = function(name, context) {    
    var context = context ? context : window;
    var properties = Array.prototype.slice.call(arguments).splice(2, 100);
    var namespaces = name.split(".");
    var func = namespaces.pop();    
    for(var i = 0; i < namespaces.length; i++) {        
        context = context[namespaces[i]];
    }    
    return context[func].apply(this, properties);
}

// generator of hashcode

var identificators = {};
var genHash = function() {
    var identificator = '';
    var identificatorLength = 10;
    var charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    var charsetLength = charset.length;
    for (i = 0; identificatorLength > i; i += 1) {  
        var charIndex = Math.random() * charsetLength;  
        identificator += charset.charAt(charIndex);  
    }    
    identificator = identificator.toLowerCase();
    if (identificators[identificator])
        return generateIdentificator();
    identificators[identificator] = true; 
    return identificator;
}