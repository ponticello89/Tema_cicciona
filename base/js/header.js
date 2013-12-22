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
});