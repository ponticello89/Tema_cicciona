//Javascript che si occupa del effetto all'header con lo scorrimento

//Attivazione paginazione dopo scorrimento fino a fine pagina
jQuery(document).ready(function($) {
	
	//$('#pagewrap').css({"min-height":  	$(window).height()+"px"});
		
	//$('.headerFake').append($('.headerSocialDiv').html());	
	//$('.headerFake').append($('.headerLevel2').html());	
	
	var $elem = $('<div>').html($('#header').html());
	var $img = $elem.remove('.headerLevel1');						
	$('.headerFake').append($img);				
	
	//$('.headerFake').width(parseInt($('.headerFake').width()));
	
	$('.headerFake').height(parseInt($('#header').height()));
	
	var statusHeader;
	var headerHeight = 100;
	var headerHeightLevel1 = parseInt($('.headerLevel1').height());
	var headerSmall  = headerHeight*1;
	$(window).scroll(function(){			
		
		if($(window).width() >= $("body").css("min-width").replace("px", "")){		
					
			//apertura
			if  ($(window).scrollTop() > headerHeight){
				$('.headerFake').fadeIn('slow');				
			}
			//chiusura
			if  ($(window).scrollTop() < headerHeight){
				$('.headerFake').fadeOut('fast');
				
			}			
			//rimpiciolimento
			if  ($(window).scrollTop() > headerSmall && statusHeader!="small"){
				statusHeader = "small";				
				$('.headerFake').animate({'top':'-'+headerHeightLevel1+'px'}, 100);						
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