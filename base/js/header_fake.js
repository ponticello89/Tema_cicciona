//Javascript che si occupa del effetto all'header con lo scorrimento

//Attivazione paginazione dopo scorrimento fino a fine pagina
jQuery(document).ready(function($) {
	
	//$('#pagewrap').css({"min-height":  	$(window).height()+"px"});

	$('.headerFake').append($('#header').html());	
	//$('.headerFake').width(parseInt($('.headerFake').width()));
	$('.headerFake').height($('#header').height());
	$(window).scroll(function(){			
		//apertura
		if  ($(window).scrollTop() > $('#header').height()){
			$('.headerFake').fadeIn('slow');
			
		}
		//chiusura
		if  ($(window).scrollTop() < $('#header').height()){
			$('.headerFake').fadeOut('slow');
			
		}			
		//rimpiciolimento
		if  ($(window).scrollTop() > ($('#header').height()*8)){			
			$('.headerFake').animate({'top':'-70px'}, 100);						
		}
		//ingrandimento
		if  ($(window).scrollTop() < ($('#header').height()*8)){			
			$('.headerFake').animate({'top':'0px'}, 10);
		}		
	});		
});