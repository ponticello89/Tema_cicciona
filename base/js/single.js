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
	
	$(window).scroll(function(){		
		if(($(window).scrollTop() + ($(window).height()/2)) <= $('.titleArticleDiv').offset().top){
			$('.leftDiv').css({
				"top" : $('.titleArticleDiv').offset().top+"px",
				"position" : "absolute"
				});
			$('.rightDiv').css({
				"top" : $('.titleArticleDiv').offset().top+"px",
				"position" : "absolute"
				});
		}else {
			$('.leftDiv').removeAttr('style');
			$('.rightDiv').removeAttr('style');
		}		
	});
});

function reSizeImageArticle(){
	var windowDefault = 950;
	var x = (widthImageArticle/windowDefault);			

	if(x != 0){
		widthImageArticle = widthImageArticle/x;
		heightImageArticle = heightImageArticle/x;
	}	
	/*
	$('.imgDiv').css({			width:  widthImageArticle,
								height: heightImageArticle,								
								"position": "relative"
								});
	*/								
	$('.imageArticle').css({	
		width:  widthImageArticle,
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
};