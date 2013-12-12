//Javascript che si occupa dell'aperture dell'immagine
var homeUrl;
jQuery(document).ready(function($) {
    
	//Esce dalla immagine
	$('.sfondoBigImage').click(function(){			
		window.history.pushState({path:homeUrl},'',homeUrl);
		$('.sfondoBigImage').fadeOut('fast');			
		$('.bigImage').fadeOut('fast');
		$('.titleBigImageDiv').fadeOut('slow');
	});
	
	//Stampa il titolo
	$('.bigImage').hover(function(){		
		$('.titleBigImageDiv').fadeIn('slow');		
	});
	
	//Nasconde il titolo
	$('.sfondoBigImage').hover(function(){					
		$('.titleBigImageDiv').fadeOut('fast');
	});				
	
	$(window).resize(function () {		
		reSizeBigImage();		
	});
});

var widthBigImage;
var heightBigImage;
function reSizeBigImage(){
	//alert(urlImage);
	var widthSfondoImage  = $(window).width();
	var heightSfondoImage = $(window).height();	
			
	var x = 0;	
	//if(heightSfondoImage<520){ heightSfondoImage = 520;}
	//if(widthSfondoImage<520){ widthSfondoImage = 520;}
	
	x = (heightBigImage/heightSfondoImage);		
	if((widthBigImage/widthSfondoImage) > x){
		x = (widthBigImage/widthSfondoImage);
	}			
	
	if(x != 0){
		widthBigImage = widthBigImage/x;
		heightBigImage = heightBigImage/x;
	}
	
	widthBigImage 	= (widthBigImage/10)*8;
	heightBigImage = (heightBigImage/10)*8;
	
	var marginTop =  parseInt((heightSfondoImage-heightBigImage)/2);
	var marginLeft = parseInt((widthSfondoImage-widthBigImage)/2);
	
	$('.bigImage').css({	width:  widthBigImage,
							height: heightBigImage,
							top: marginTop+"px",
							left: marginLeft+"px"
							});	
							
	var heightTitleBigImageDiv = parseInt((heightSfondoImage/10)*0.7);
	if(heightTitleBigImageDiv>40){ heightTitleBigImageDiv = 40;}
	var marginTopTitleBigImageDiv = parseInt(marginTop)+parseInt(heightBigImage)-parseInt(heightTitleBigImageDiv)+1;
	
	$('.titleBigImageDiv').css({	width:  widthBigImage,
								height: heightTitleBigImageDiv,
								top: marginTopTitleBigImageDiv+"px",
								left: marginLeft+"px",
								});
								
	var fontTitleBigImage = parseInt((heightTitleBigImageDiv/10)*6);
	var marginTitleBigImage = parseInt((heightTitleBigImageDiv/10)*2);
	
	$('.titleBigImage').css({	"font-size": fontTitleBigImage+"px",
								"color": "white",
								"margin": marginTitleBigImage+"px",
								"line-height": "normal"
							});
}

function apriImg(urlImage, urlArticle, titleImage, widthImage, heightImage){
	//return false;
	
	homeUrl = window.location+"";		
	window.history.pushState({path:urlArticle},'',urlArticle);
		
	$('.titleBigImage').empty();

	widthBigImage = widthImage;
	heightBigImage = heightImage;
			
	$('.sfondoBigImage').fadeIn('slow');
	$('.bigImage').attr('src',urlImage);				
	$('.bigImage').fadeIn('slow');
	$('.titleBigImage').append(titleImage);
	
	reSizeBigImage();	
}
function apriImg_(urlImage, urlArticle, titleImage, widthImage, heightImage){
	//return false;
	
	homeUrl = window.location+"";		
	window.history.pushState({path:urlArticle},'',urlArticle);
		
	$('.titleBigImage').empty();

	//alert(urlImage);
	var widthSfondoImage = $(".sfondoBigImage").width();
	var heightSfondoImage = $(".sfondoBigImage").height();	
			
	var x = 0;	
	if(heightSfondoImage<520){ heightSfondoImage = 520;}
	if(widthSfondoImage<520){ widthSfondoImage = 520;}
	
	x = (heightImage/heightSfondoImage);		
	if((widthImage/widthSfondoImage) > x){
		x = (widthImage/widthSfondoImage);
	}			
	
	if(x != 0){
		widthImage = widthImage/x;
		heightImage = heightImage/x;
	}
	
	widthImage 	= (widthImage/10)*8;
	heightImage = (heightImage/10)*8;
	
	var marginTop =  parseInt((heightSfondoImage-heightImage)/2);
	var marginLeft = parseInt((widthSfondoImage-widthImage)/2);
	
	$('.sfondoBigImage').fadeIn('slow');
	$('.bigImage').attr('src',urlImage);
	$('.bigImage').css({	width:  widthImage,
							height: heightImage,
							top: marginTop+"px",
							left: marginLeft+"px"
							});				
	$('.bigImage').fadeIn('slow');
	
	var heightTitleBigImageDiv = parseInt((heightSfondoImage/10)*0.7);
	if(heightTitleBigImageDiv>40){ heightTitleBigImageDiv = 40;}
	var marginTopTitleBigImageDiv = parseInt(marginTop)+parseInt(heightImage)-parseInt(heightTitleBigImageDiv)+1;
	
	$('.titleBigImageDiv').css({	width:  widthImage,
								height: heightTitleBigImageDiv,
								top: marginTopTitleBigImageDiv+"px",
								left: marginLeft+"px",
								});
								
	$('.titleBigImage').append(titleImage);
	
	var fontTitleBigImage = parseInt((heightTitleBigImageDiv/10)*6);
	var marginTitleBigImage = parseInt((heightTitleBigImageDiv/10)*2);
	
	$('.titleBigImage').css({	"font-size": fontTitleBigImage+"px",
								"color": "white",
								"margin": marginTitleBigImage+"px",
								"line-height": "normal"
							});
}