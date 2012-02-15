$(function() {

	// parallax init

	$("div.cloud1").scrollingParallax({
        staticSpeed : .15,
        staticScrollLimit : false
    });
	
	$("div.cloud2").scrollingParallax({
        staticSpeed : .17,
        staticScrollLimit : false
    });
	
	$("div.cloud3").scrollingParallax({
        staticSpeed : .20,
        staticScrollLimit : false
    });
	
	$("div.cloud4").scrollingParallax({
        staticSpeed : .23,
        staticScrollLimit : false
    });
	
	$("div.cloud5").scrollingParallax({
        staticSpeed : .26,
        staticScrollLimit : false
    });
	
	// placeholder init
	
	$('input[placeholder], textarea[placeholder]').placeholder();

})