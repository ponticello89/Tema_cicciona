//Javascript che si occupa del bottone torna-su

jQuery(document).ready(function($) {
    	
	//Comparsa del pulsante torna su dopo un determinato scorrimento verso il basso
	$(window).scroll(function(){
	
		if($(window).width() >= $("body").css("min-width").replace("px", "")){		
			if ($(this).scrollTop() > 300) {
				$('.tornaSu').fadeIn();
			} else {
				$('.tornaSu').fadeOut();
			}
		}
	});
	
	//Torna su con animazione a scorrimento lenta
	$('.tornaSu').click(function(){
		$("html, body").animate({ scrollTop: 0 }, 'slow');		
		return false;
	});	
	
	//comparsa e sparizione in caso di window troppo piccola
	$(window).resize(function () {		
		if($(window).width() >= $("body").css("min-width").replace("px", "")){
			if  ($(window).scrollTop() > headerHeight){
				$('.tornaSu').fadeIn();
			}
		}else{
			$('.tornaSu').fadeOut();
		}
		
	});
});