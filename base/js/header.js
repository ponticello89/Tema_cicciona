//Javascript che si occupa del effetto all'header con lo scorrimento

//Attivazione paginazione dopo scorrimento fino a fine pagina
jQuery(document).ready(function($) {
	reSizeHeader();	
	
	//comparsa e sparizione in caso di window troppo piccola
	$(window).resize(function () {		
		reSizeHeader();
	});
	
	function reSizeHeader(){		
		//alert($('.headerCategoriesUl').padding());
		
		$('.headerLevel1').height(parseInt($('.headerTitleDiv').outerHeight(true)));
		$('.headerLevel2').height(parseInt($('.headerCategoriesUl').outerHeight(true)));
		$('#header').height(parseInt($('.headerLevel2').outerHeight(true))+parseInt($('.headerLevel1').outerHeight(true)));
	}
	
	/*
	$('.navPhone').css({"-webkit-transition": "all 0.2s ease-in",
								"-webkit-transform"	: "translate3d(-356px, 0, 0)"
							});
	*/
	var aperto = false;
	$('.menuRightBtn').click(function (){
		var widthMobileNav = 356;		
		if(((screen.width/100)*80)<widthMobileNav){
			widthMobileNav = (screen.width/100)*80;
			$('.navPhone').width(widthMobileNav);
		}

		if(!aperto){
			aperto = true;
			$('#pagewrap').css({"-webkit-transition": "all 0.2s ease-in",
								//"-webkit-transform"	: "translate3d(356px, 0, 0)"
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
								//"-webkit-transform"	: "translate3d(-356px, 0, 0)"
								"-webkit-transform"	: "translate3d(-"+widthMobileNav+"px, 0, 0)"
							});
		}
	});	
});