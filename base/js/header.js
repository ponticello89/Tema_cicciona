//Javascript che si occupa del effetto all'header con lo scorrimento

//Attivazione paginazione dopo scorrimento fino a fine pagina
jQuery(document).ready(function($) {
	reSizeHeader();	
	
	var aperto = false;
	
	//comparsa e sparizione in caso di window troppo piccola
	$(window).resize(function () {		
		reSizeHeader();
		if($(window).width() > 800){
			 $.sidr('close', 'menu-left');	
		}			
	});					
	
	$('#pagewrap').click(function () {				
		$.sidr('close', 'menu-left');			
	});				
});

function reSizeHeader(){	
	/*
	if($('.logoSite') != null){		
		if($('.logoSite').height() > $('.headerTitleDiv').height()){			
			$('.headerTitleDiv').height($('.logoSite').height()); 
		}
	}
	
	$('.headerLevel1').height(parseInt($('.headerTitleDiv').outerHeight(true)));
	//$('.headerLevel2').height(parseInt($('.headerCategoriesUl').outerHeight(true)));
	//$('.headerSocialDiv').height(parseInt($('.headerSocialDiv').find('.socialDiv').outerHeight(true)));
	var heightHeader = 0;
	heightHeader = parseInt($('.headerLevel2').outerHeight(true)) + parseInt($('.headerLevel1').outerHeight(true));
	if($('.headerSocialDiv').length > 0){		
		heightHeader = heightHeader + parseInt($('.headerSocialDiv').outerHeight(true));
	}
	$('#header').height(heightHeader);	
	*/
}	