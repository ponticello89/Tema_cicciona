var widthImageArticle;
var heightImageArticle;

function initializeDimension (width, height){
	widthImageArticle = width;
	heightImageArticle = height;
}

jQuery(document).ready(function($) {
	
	//NAVIGATION	
	$('.leftArrowP').css({	
		"transform": 			"translate(20px,0px)",
		"-ms-transform": 		"translate(20px,0px)", 
		"-webkit-transform": 	"translate(20px,0px)", 
		"-o-transform": 		"translate(20px,0px)", 
		"-moz-transform": 		"translate(20px,0px)",
		"-webkit-transition": 	"all 0.9s ease-in-out",
		"-moz-transition":		"all 0.9s ease-in-out",
		"-o-transition": 		"all 0.9s ease-in-out",
		"transition": 			"all 0.9s ease-in-out"
	});
	
	$('.rightArrowP').css({	
		"transform": 			"translate(-20px,0px)",
		"-ms-transform": 		"translate(-20px,0px)", 
		"-webkit-transform": 	"translate(-20px,0px)", 
		"-o-transform": 		"translate(-20px,0px)", 
		"-moz-transform": 		"translate(-20px,0px)",
		"-webkit-transition": 	"all 0.9s ease-in-out",
		"-moz-transition":		"all 0.9s ease-in-out",
		"-o-transition": 		"all 0.9s ease-in-out",
		"transition": 			"all 0.9s ease-in-out"
	});
	
	if(isPhone == "0"){		
		reSizeImageArticle();
				
		var scrollHeight = parseInt($('.titleArticleDiv').offset().top);
		$("html, body").animate({ scrollTop: scrollHeight }, 'slow');	
		
		$(window).resize(function () {		
			reSizeImageArticle();		
		});
	}else{				
		reSizeImageArticle_Mobile();
		
		var scrollHeight = parseInt($('.titleArticleDiv').offset().top);
		$("html, body").animate({ scrollTop: scrollHeight }, 'slow');		
		
		var windowMobileHeight = screen.height;
		var windowMobileWidth = screen.width;
		
		$(window).resize(function () {		
			reSizeImageArticle_Mobile();			
			//Se il telefono viene capovolto			
			if(windowMobileHeight == screen.width && windowMobileWidth == screen.height){
				windowMobileHeight = screen.height;
				windowMobileWidth  = screen.width;
					
				scrollHeight = parseInt($('.titleArticleDiv').offset().top);
				$("html, body").animate({ scrollTop: scrollHeight }, 'slow');		
			}
		});
	}
});

function reSizeImageArticle(){
	var windowDefault = 950;
	var x = (widthImageArticle/windowDefault);			

	if(x != 0){
		widthImageArticle = widthImageArticle/x;
		heightImageArticle = heightImageArticle/x;
	}	
	
	$('.imgDiv').css({			width:  widthImageArticle,
								height: heightImageArticle,								
								"position": "relative"
								});
										
	$('.imageArticle').css({	width:  widthImageArticle,
								height: heightImageArticle,								
								});
};

function reSizeImageArticle_Mobile(){	
	if(heightImageArticle > $(window).height()){		
		$('.imgDiv').find('img').css({
			"max-height": $(window).height()+"px",
			"max-width": "95%",			
			"height": "auto",
			"width": "auto"
			});		
	}else{
		$('.imgDiv').find('img').removeAttr('style');
	}
}

//****************************
//NON USATO PIU
//****************************
function reSizeImageArticle_Mobile_dinamic(){
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

function reSizeImageArticle_dinamic(){
	var widthWindow	 = $("#pagewrap").width();
	//var heightWindow = $("#pagewrap").height();	
	//var heightWindow = $(window).height();	
	var heightWindow = screen.height;	
	
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

	widthImageArticle  = (widthImageArticle/10)*8;
	heightImageArticle = (heightImageArticle/10)*8;	
	
	var marginTop =  (heightWindow-heightImageArticle)/2;
	var marginLeft = (widthWindow-widthImageArticle)/2;
	
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
