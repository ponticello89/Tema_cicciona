var widthImageArticle;
var heightImageArticle;

function initializeDimension (width, height){
	widthImageArticle = width;
	heightImageArticle = height;
}

jQuery(document).ready(function($) {
	if(isPhone==0){
		reSizeImageArticle();
		
		$(window).resize(function () {		
			reSizeImageArticle();		
		});
	}else{
		reSizeImageArticle_Mobile();
		
		var scrollHeight = parseInt($('.imgDiv').offset().top);
		$("html, body").animate({ scrollTop: scrollHeight }, 'slow');		
		
		var windowMobileHeight = screen.height;
		var windowMobileWidth = screen.width;
		
		$(window).resize(function () {		
			reSizeImageArticle_Mobile();			
			//Se il telefono viene capovolto			
			if(	windowMobileHeight == screen.width 
				&& windowMobileWidth == screen.height){
					windowMobileHeight = screen.height;
					windowMobileWidth  = screen.width;
					scrollHeight = parseInt($('.imgDiv').offset().top);
					$("html, body").animate({ scrollTop: scrollHeight }, 'slow');		
			}
		});
	}
});

function reSizeImageArticle(){
	var widthWindow	 = $("#pagewrap").width();
	//var heightWindow = $("#pagewrap").height();	
	var heightWindow = $(window).height();	
	
	var x;
			
	//alert(heightWindow+"-"+widthWindow);
	x = (heightImageArticle/heightWindow);		
	if((widthImageArticle/widthWindow) > x){
		x = (widthImageArticle/widthWindow);		
	}

	if(x != 0){
		widthImageArticle = widthImageArticle/x;
		heightImageArticle = heightImageArticle/x;
	}

	widthImageArticle 	= parseInt((widthImageArticle/10)*8);
	heightImageArticle = parseInt((heightImageArticle/10)*8);	
	
	var marginTop =  parseInt((heightWindow-heightImageArticle)/2);
	var marginLeft = parseInt((widthWindow-widthImageArticle)/2);
	
	$('.imgDiv').css({			width:  widthImageArticle,
								height: heightImageArticle,
								//top: marginTop+"px",
								left: marginLeft+"px",
								"position": "relative"
								});
										
	$('.imageArticle').css({	width:  widthImageArticle,
								height: heightImageArticle,
								//top: marginTop+"px",
								//left: marginLeft+"px"
								});
	
	$('.leftArrowP').css({		"margin-top": (heightImageArticle/2)-(($('.leftArrowP').height())/2)+"px"
								});
								
	$('.rightArrowP').css({		"margin-top": (heightImageArticle/2)-(($('.rightArrowP').height())/2)+"px"
								});
								
	$('.leftDiv').css({			width:  (widthImageArticle/2),
								height: heightImageArticle,
								//top: marginTop+"px",
								//left: marginLeft+"px",
								"position": "absolute"
								});
								
	$('.rightDiv').css({		width:  (widthImageArticle/2),
								height: heightImageArticle,
								//top: marginTop+"px",
								left: (widthImageArticle/2)+"px",
								"position": "absolute"
								});
}

function reSizeImageArticle_Mobile(){
	var widthWindow	 = $("#pagewrap").width();
	//var heightWindow = $("#pagewrap").height();	
	var heightWindow = $(window).height();	
	
	var x;
			
	//alert(heightWindow+"-"+widthWindow);
	x = (heightImageArticle/heightWindow);		
	if((widthImageArticle/widthWindow) > x){
		x = (widthImageArticle/widthWindow);		
	}

	if(x != 0){
		widthImageArticle = widthImageArticle/x;
		heightImageArticle = heightImageArticle/x;
	}

	widthImageArticle 	= parseInt((widthImageArticle));
	heightImageArticle = parseInt((heightImageArticle));	
	
	var marginTop =  parseInt((heightWindow-heightImageArticle)/2);
	var marginLeft = parseInt((widthWindow-widthImageArticle)/2);
	
	$('.imgDiv').css({			width:  widthImageArticle,
								height: heightImageArticle,
								//top: marginTop+"px",
								left: marginLeft+"px",
								"position": "relative"
								});
										
	$('.imageArticle').css({	width:  widthImageArticle,
								height: heightImageArticle,
								//top: marginTop+"px",
								//left: marginLeft+"px"
								});
	
	$('.leftArrowP').css({		"margin-top": (heightImageArticle/2)-(($('.leftArrowP').height())/2)+"px"
								});
								
	$('.rightArrowP').css({		"margin-top": (heightImageArticle/2)-(($('.rightArrowP').height())/2)+"px"
								});
								
	$('.leftDiv').css({			width:  (widthImageArticle/2),
								height: heightImageArticle,
								//top: marginTop+"px",
								//left: marginLeft+"px",
								"position": "absolute"
								});
								
	$('.rightDiv').css({		width:  (widthImageArticle/2),
								height: heightImageArticle,
								//top: marginTop+"px",
								left: (widthImageArticle/2)+"px",
								"position": "absolute"
								});	
}