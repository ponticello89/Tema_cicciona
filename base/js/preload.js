//Javascript che si occupa del preload delle immagini
	
//Funzione che si occupera di settare preload delle immagini
//prende tutte le immagini con un determinato class in un determinato preload
//settandogli una animazione nel momento del complete ed eliminando la suddetta classe 
var run;
function loadImageTime(contenitore, classeImage){
	var checkIfLoadedTimer2 = setInterval(
		function(){
			if(run=="false"){
				loadImage(contenitore, classeImage);
				clearInterval(checkIfLoadedTimer2);
			}
		}
		, 300);
}

function loadImage(contenitore, classeImage, opacity, subClassPreload){
	//Debug
	//alert('loadImage ');
		var subPreLoad;
	
		if(subClassPreload != null && subClassPreload != ""){
			var subPreLoad = $(contenitore).find(subClassPreload);
			subPreLoad.filter(subClassPreload).each(function () {
				$(this).css("opacity", "0");
			});
		}
		
		var imagesToLoad = $(contenitore).find(classeImage);
		var imagesToLoadCount = imagesToLoad.size();
		
		var checkIfLoadedTimer = 
			setInterval(
				function () {
					//alert('a');
					if (!imagesToLoadCount) {
						clearInterval(checkIfLoadedTimer);
						
					} else {
						imagesToLoad.filter(classeImage).each(function () {
							if (this.complete) {
								//fadeImageIn(this);								
								if (!$(this).is(':animated')) {									
									//$(this).removeClass(classeImage);
									$(this).removeClass("preload");
									//$(".loadit").remove();
									
									$(this)	.css({visibility: "visible"})
											.animate({	"opacity": opacity}, 
														300, 
														function () {																														
															$(this).css("opacity", "");
															if(subClassPreload != null && subClassPreload != ""){
																subPreLoad = $(contenitore).find(subClassPreload);
																subPreLoad.filter(subClassPreload).each(function () {
																	$(this).css("opacity", "");
																});
															}
														});
									
									//setTimeout(function(){$(this).removeAttr('style');}, 450);
									
									//$(this).fadeIn(300);
									imagesToLoadCount--;
								}								
							}
						});
					}
				}, 
				300);

		var fadeImageIn = 
			function (imageToLoad) {
				$(imageToLoad).css({visibility: "visible"}).animate({opacity: 1}, 300, function () {
					$(imageToLoad).removeClass(classeImage);
				});
			};
	
}