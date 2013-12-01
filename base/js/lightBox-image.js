//Javascript che si occupa dell'aperture dell'immagine

jQuery(document).ready(function($) {
    	
	$('.sfondoBigImage').click(function(){		
		$('.sfondoBigImage').fadeOut('fast');			
		$('.bigImage').fadeOut('fast');
		$('.titleBigImage').fadeOut('fast');
	});
	
	$('.bigImage').hover(function(){					
		$('.titleBigImage').fadeIn('slow');
	});
	
	$('.sfondoBigImage').hover(function(){					
		$('.titleBigImage').fadeOut('fast');
	});
});

function apriImg(urlImage, widthImage, heightImage){		
	//alert(urlImage);
	var widthSfondoImage = $(".sfondoBigImage").width();
	var heightSfondoImage = $(".sfondoBigImage").height();	
			
	var x = 0;
	if(heightImage > heightSfondoImage){
		x = (heightImage/heightSfondoImage);
	} if (widthImage > widthSfondoImage){
		if((widthImage/widthSfondoImage) > x){
			x = (widthImage/widthSfondoImage);
		}			
	}		
	if(x != 0){
		widthImage = widthImage/x;
		heightImage = heightImage/x;
	}
	
	widthImage 	= (widthImage/10)*8;
	heightImage = (heightImage/10)*8;
	
	var marginTop =  (heightSfondoImage-heightImage)/2;
	var marginLeft = (widthSfondoImage-widthImage)/2;
	
	$('.sfondoBigImage').fadeIn('slow');
	$('.bigImage').attr('src',urlImage);
	$('.bigImage').css({	width:  widthImage,
							height: heightImage,
							top: marginTop+"px",
							left: marginLeft+"px",
							});				
	$('.bigImage').fadeIn('slow');
	
	var heightTitleBigImage = (heightSfondoImage/10)*0.7;
	var marginTopTitleBigImage = marginTop+heightImage-heightTitleBigImage+1;
	
	$('.titleBigImage').css({	width:  widthImage,
								height: heightTitleBigImage,
								top: marginTopTitleBigImage+"px",
								left: marginLeft+"px",
								});
}