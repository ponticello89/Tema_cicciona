//Javascript che si occupa del effetto all'header con lo scorrimento

//Attivazione paginazione dopo scorrimento fino a fine pagina
jQuery(document).ready(function($) {
	reSizeHeader();	
	
	//comparsa e sparizione in caso di window troppo piccola
	$(window).resize(function () {		
		reSizeHeader();
	});
			
	var aperto = false;
	var widthMobileNav = 356;		
	if(((screen.width/100)*50) < widthMobileNav){
		widthMobileNav = (screen.width/100)*50;						
	}	
	$('.navPhone').width(widthMobileNav);	
	$('.navPhone').height(window.height);
	$('.menuRightBtn').click(function (){		
		if(!aperto){
			aperto = true;			
			$('#pagewrap').css({"-webkit-transition": "all 0.2s ease-in",								
								"-webkit-transform"	: "translate3d("+widthMobileNav+"px, 0, 0)"
							});
			$('.navPhone').css({"-webkit-transition": "all 0.2s ease-in",
								"-webkit-transform"	: "translate3d(0px, 0, 0)"
							});
		}else{
			aperto = false;
			$('#pagewrap').css({"-webkit-transition": "all 0.2s ease-in",
							"-webkit-transform"	: "translate3d(0px, 0, 0)"
						  });
			$('.navPhone').css({"-webkit-transition": "all 0.2s ease-in",								
								"-webkit-transform"	: "translate3d(-"+widthMobileNav+"px, 0, 0)"
							});			
		}
	});	
	
	$('#pagewrap').mouseover(function (){
		if(aperto){
			aperto = false;			
			$('#pagewrap').css({"-webkit-transition": "all 0.4s ease-in",
							"-webkit-transform"	: "translate3d(0px, 0, 0)"
						  });
			$('.navPhone').css({"-webkit-transition": "all 0.4s ease-in",								
								"-webkit-transform"	: "translate3d(-"+widthMobileNav+"px, 0, 0)"
							});
		}
	});
});


function reSizeHeader(){	
	if($('.logoSite') != null){		
		if($('.logoSite').height() > $('.headerTitleDiv').height()){			
			$('.headerTitleDiv').height($('.logoSite').height()); 
		}
	}
	
	$('.headerLevel1').height(parseInt($('.headerTitleDiv').outerHeight(true)));
	$('.headerLevel2').height(parseInt($('.headerCategoriesUl').outerHeight(true)));
	$('#header').height(parseInt($('.headerLevel2').outerHeight(true))+parseInt($('.headerLevel1').outerHeight(true)));
}	