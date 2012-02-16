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