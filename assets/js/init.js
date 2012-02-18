$(function() {

	// parallax init
	
	$("div.cloud0").scrollingParallax({
        staticSpeed : .10,
        staticScrollLimit : false
    });
	
	$("div.cloud1").scrollingParallax({
        staticSpeed : .15,
        staticScrollLimit : false
    });
	
	$("div.cloud2").scrollingParallax({
        staticSpeed : .19,
        staticScrollLimit : false
    });
	
	$("div.cloud3").scrollingParallax({
        staticSpeed : .22,
        staticScrollLimit : false
    });
	
	$("div.cloud4").scrollingParallax({
        staticSpeed : .25,
        staticScrollLimit : false
    });
	
	$("div.cloud5").scrollingParallax({
        staticSpeed : .28,
        staticScrollLimit : false
    });
	
	// menu
	$('.top-menu li').hover(function(){
			$(this).addClass('tm-hover');
		}, function(){
			$(this).removeClass('tm-hover');
	});	
	  
	// seleector style
	$('.ss').sSelect({ddMaxHeight: '400px'});
	
	// placeholder init	
	$('input[placeholder], textarea[placeholder]').placeholder();
	
	// live buttons	
	$('a#auth_show_popup').overlay({
		mask:'#fff',
		target: 'div#auth_popup',
		top: 'center',
		left: '50%'
	})
	

})