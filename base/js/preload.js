//Javascript che si occupa del preload delle immagini
	
//Funzione che si occupera di settare preload delle immagini
//prende tutte le immagini con un determinato class in un determinato preload
//settandogli una animazione nel momento del complete ed eliminando la suddetta classe 
function loadImage(contenitore, classeImage){
	//Debug
	//alert('loadImage ');
		
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
							fadeImageIn(this);
							imagesToLoadCount--;
						}
					});
				}
			}, 
			300);

	var fadeImageIn = 
		function (imageToLoad) {
            $(imageToLoad).css({visibility: "visible"}).animate({opacity: 1}, 900, function () {
                $(imageToLoad).removeClass(classeImage);
            });
        };
}