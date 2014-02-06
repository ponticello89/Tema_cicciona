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
	
	gestoreFrecce();
	
	/*
	if(isPhone == "0"){		
		alert(screen.width);
		//$(window).height()
		if(screen.width >= 950){
			reSizeImageArticle();
		}else{
			reSizeImageArticle_Mobile();
		}
		
		var scrollHeight = parseInt($('.imgDiv').offset().top);
		$("html, body").animate({ scrollTop: scrollHeight }, 'slow');	
		
		$(window).resize(function () {		
			
			if(screen.width >= 950){
				reSizeImageArticle();
			}else{
				reSizeImageArticle_Mobile();
			}
			
			gestoreFrecce();
		});
	}else{				
		reSizeImageArticle_Mobile();
		
		var scrollHeight = parseInt($('.titleArticleDiv').offset().top);
		$("html, body").animate({ scrollTop: scrollHeight }, 'slow');		
		
		var windowMobileHeight = screen.height;
		var windowMobileWidth = screen.width;
		
		$(window).resize(function () {
			gestoreFrecce();
			
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
	*/
	$(window).scroll(function(){
		gestoreFrecce();
	});
});

function reSizeImageArticle(){
	if(heightImageArticle > $(window).height()){		
		$('.imageArticle').css({
			"max-height": $(window).height()+"px",
			"max-width": "95%",			
			"height": "auto",
			"width": "auto"
			});		
	}else{
		$('.imageArticle').removeAttr('style');
	}
};

function reSizeImageArticle__(){
	var windowDefault = 950;
	var x = (widthImageArticle/windowDefault);			

	if(x != 0){
		widthImageArticle = widthImageArticle/x;
		heightImageArticle = heightImageArticle/x;
	}

	if(heightImageArticle > $(window).height()){		
		//$('.imgDiv').find('img').css({
		$('.imageArticle').css({
			"max-height": $(window).height()+"px",
			"min-height": $(window).height()+"px",
			"max-width": "950px",			
			"height": "auto",
			"width": "auto"
			});		
	}else{
		$('.imgDiv').find('img').removeAttr('style');
	}
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

function gestoreFrecce(){
	if((parseInt($(window).scrollTop()) + (parseInt($(window).height())/2)) < parseInt($('.titleArticleDiv').offset().top)){		
		if($('.leftDiv').length > 0){
			$('.leftDiv').fadeOut(1);
		}
		if($('.rightDiv').length > 0){
			$('.rightDiv').fadeOut(1);
		}
	}else{
		if($('.leftDiv').length > 0){
			$('.leftDiv').fadeIn();
		}
		if($('.rightDiv').length > 0){
			$('.rightDiv').fadeIn();		
		}
	}
}