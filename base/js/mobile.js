jQuery(document).load(function($) {																
	$("body").css("width", $(window).width()+"px");
	$("body").css("min-width", $(window).width()+"px");
	$("html").css("width", $(window).width()+"px");				
	$("html").css("min-width", $(window).width()+"px");								
	
	$(window).resize(function(){
		$("body").css("width", $(window).width()+"px");
		$("body").css("min-width", $(window).width()+"px");
		$("html").css("width", $(window).width()+"px");				
		$("html").css("min-width", $(window).width()+"px");								
	});	
	
	//Debug
	//$("body").css("width", "400px");
	//$("body").css("min-width", "400px");
	//$("html").css("width", "400px");				
	//$("html").css("min-width", "400px");			
});