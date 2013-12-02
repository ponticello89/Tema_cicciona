//Javascript che si occupa dell'aperture dell'immagine

jQuery(document).ready(function($) {
    	
	$('.sfondoBigImage').click(function(){		
		$('.sfondoBigImage').fadeOut('fast');			
		$('.bigImage').fadeOut('fast');
		$('.titleBigImageDiv').fadeOut('fast');
	});
	
	$('.bigImage').hover(function(){					
		$('.titleBigImageDiv').fadeIn('slow');
	});
	
	$('.sfondoBigImage').hover(function(){					
		$('.titleBigImageDiv').fadeOut('fast');
	});
});

function apriImg(urlImage, titleImage, widthImage, heightImage){

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
							left: marginLeft+"px",
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