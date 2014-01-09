jQuery(document).ready(function($) {	
	reSizeBody();
	
	$(window).resize(function(){
		reSizeBody();
	});		
});

function reSizeBody(){	
	$("body").css("width", 		$(window).width()+"px");
	$("body").css("min-width", 	$(window).width()+"px");
	$("html").css("width", 		$(window).width()+"px");				
	$("html").css("min-width", 	$(window).width()+"px");								
}