//Javascript che si occupa del effetto all'header con lo scorrimento

//Attivazione paginazione dopo scorrimento fino a fine pagina
jQuery(document).ready(function($) {
	
	//$('#pagewrap').css({"min-height":  	$(window).height()+"px"});
		
	$('.headerFake').append($('#header').html());	
	//$('.headerFake').width(parseInt($('.headerFake').width()));
	$('.headerFake').height(parseInt($('#header').height()));
	
	var statusHeader;
	var headerHeight = $('#header').height();
	var headerSmall  = headerHeight*8;
	$(window).scroll(function(){			
		
		if($(window).width() >= $("body").css("min-width").replace("px", "")){		
					
			//apertura
			if  ($(window).scrollTop() > headerHeight){
				$('.headerFake').fadeIn('slow');				
			}
			//chiusura
			if  ($(window).scrollTop() < $('#header').height()){
				$('.headerFake').fadeOut('fast');
				
			}			
			//rimpiciolimento
			if  ($(window).scrollTop() > headerSmall && statusHeader!="small"){
				statusHeader = "small";
				$('.headerFake').animate({'top':'-50px'}, 100);						
			}
			//ingrandimento
			if  ($(window).scrollTop() < headerSmall && statusHeader!="big"){
				statusHeader = "big";
				$('.headerFake').animate({'top':'0px'}, 10);
			}		
		}else{
			$('.headerFake').fadeOut('fast');
		}		
	});		
	
	//comparsa e sparizione in caso di window troppo piccola
	$(window).resize(function () {		
		if($(window).width() >= $("body").css("min-width").replace("px", "")){
			if  ($(window).scrollTop() > headerHeight){
				$('.headerFake').fadeIn('fast');
			}
		}else{
			$('.headerFake').fadeOut('fast');
		}
		
	});
});