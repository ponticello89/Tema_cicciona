//Javascript che si occupa del effetto all'header con lo scorrimento

//Attivazione paginazione dopo scorrimento fino a fine pagina
jQuery(document).ready(function($) {
	$('.headerFake').append($('#header').html());	
	//$('.headerFake').width(parseInt($('.headerFake').width()));
	$('.headerFake').height($('#header').height());
	$(window).scroll(function(){			
		if  ($(window).scrollTop() > $('#header').height()){
			$('.headerFake').fadeIn('slow');
			
		}
		if  ($(window).scrollTop() < $('#header').height()){
			$('.headerFake').fadeOut('slow');
			
		}			
	});		
});