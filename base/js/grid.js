//Javascript che si occupa della creazione della tabella

//Contatore delle immagini inserite
var totaleImg = 0;
//Contatore delle pagine contenenti immagini inserite
var countPage = 1;

var finishImage = "false";
//Numero dei div-colonna desiderati
//var numDiv = 3;
//arrey che contiene id e url dell'immagine che serve per il preload e il caricamento
imgArray=new Array();

heightColArray = new Array();

//Funzioni che partono al caricamento della pagina
jQuery(document).ready(function($) {
	
	//Funzioni che partono al caricamento della pagina
	$(document).ready(					
		function () {
			//Settaggio larghezza griglia
			setWidthGrid(widthGridValue);			
			//Creazione colonne
			createDiv(numDiv, widthCols);			
			//Caricamento della prima pagina di immagini
			var bool = loadArticle(countPage);	
			if(bool){
				countPage++;						
			}
		}			
	)
	
	//Attivazione paginazione dopo scorrimento fino a fine pagina
	$(window).scroll(function(){
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			if (finishImage=="true"){
				return false;
			}else{						
				var bool = loadArticle(countPage);				
				if(bool){
					countPage++;
				}
		    }			   
		}			
	});		
});

//Funzione che restituisce la pagina contenente le immagini indicata come parametro e la appende nel div
//***Funzione complessa***
// 1) Tramite ajax viene richiesta la pagina specifica contenente l'insieme delle immagini a wordpress che viene affidata nel file php (loop_home)
// 2) il file php cicla per il numero le immagini: 
// 	  - settando l'array contenente l'url dell'immagine associata al numero (loadArray)
//    - chiamando la funzione che colloca nel div un codice html che conterrà l'immagine(loadPhotoOnDiv)
// 3) alla fine del processo ajax viene chiamato il preload che scrive l'immagine nel contenitore e setta l'azione a fine caricamento
// 4) viene chiamata una funzione che controlla se l'insieme delle immagini stampate arrivi a fine pagina per attivare lo scroll
var load = "false";
function loadArticle(pageNumber){
	//Debug
	//alert('loadArticle('+urlSite+')');
	if(load == "false"){
		load = "true";	
		$('a.inifiniteLoader').show('fast');
		$.ajax({		
			url: urlSite+"/wp-admin/admin-ajax.php",		
			type:'POST',
			data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=includes/loop_home', 
			success: function(html){           						
				$('a.inifiniteLoader').hide('1000');			
				$("#photosx").append(html);    // This will be the div where our content will be loaded																	
			},
			complete: function(){
				load = "false";	
				loadArticleForScroll();			
				//Settaggio dei margini delle immagini
				setMarginImage(marginImageValue);
				loadImage("#photosx", ".preload", "0.7");		
							
			}
		});		
		return true;	
	}
	return false;
}

//Settaggio larghezza griglia
function setWidthGrid(widthGrid){
	$("#photosx").width(widthGrid+"%");
}

//Settaggio larghezza griglia
function setMarginImage(marginImageValue){	
	$(".colonna").css({		"margin-left":  	marginImageValue+"px"});
	$(".imageCella").css({	"margin-bottom":  	marginImageValue+"px"});
}

//Funzione che crea i div-colonna che conterranno verticalmente le immagini
function createDiv(numDiv, widthCols){
	
	var widthColsArray = widthCols.split(",");
					
	for (i=1; i<=numDiv; i++) {
		//Creo il div colonna
		var divHtml = "<div id=\"colonna"+i+"\" style=\"width: "+((widthColsArray[(i-1)])-1)+"%;\" class=\"colonna colonnaPhoto\">";		
		
		//Lo appendo
		$("#photosx").append(divHtml);
		
		//Ri calcolo il width togliendo le cifre dopo la virgola per evitare sfarfallii
		$("#colonna"+i).width(parseInt($("#colonna"+i).width()));
		
		//Inizializzo l'array height con valore 0
		heightColArray [i] = 0;		
	}
	
	//Settaggio dei margini delle immagini
	//setMarginImage(marginImageValue);
}

//Funzione che controlla se l'insieme delle immagini stampate attivino lo scroll
function loadArticleForScroll(){		
	if(document.body.clientHeight < $(window).height()){							
		if (finishImage=='true'){
			return false;
		}else{	
			var bool = loadArticle(countPage);	
			if(bool){				
				countPage++;			
			}
		}			   			
	}
}

//Funzione che si occupa di collocare l'articolo nel div giusto
function loadPhotoOnDiv(html, widthImage, heightImage){
	//Debug
	//alert('loadPhotoOnDiv(html) totaleImg = '+totaleImg+' size = '+width+'x'+height);
	
	//Calcolo il collocamento
	var divSelect = 0;
	var heightMoreLittle = -1;
	for (i=numDiv; i>0; i--) {		
		if(heightMoreLittle == -1){
			heightMoreLittle = heightColArray [i] ;
			divSelect = i;
		} else {
			if (heightMoreLittle > heightColArray[i]){
				heightMoreLittle = heightColArray [i] ;
				divSelect = i;
			}
		}
	}
	
	//Se wordpress impazzisce e non setta il width dell'immagine non stampo
	if(widthImage!=0){				
		//Appende HTML immagine nelle colonne 
		$("#colonna"+divSelect).append(html);
				
		//Setto nell'array le grandezze delle colonne per calcolare il collocamento
		var widthColonna = $("#colonna"+divSelect).width();
		var x = (widthImage/widthColonna);		
		heightImage = heightImage/x;		
		heightColArray [divSelect] = parseInt(heightColArray [divSelect]) + parseInt(heightImage);
		
		totaleImg++;
	}
}
	
//Funzione che si occupera di settare preload delle immagini
//prende tutte le immagini con un determinato class in un determinato preload
//settandogli una animazione nel momento del complete ed eliminando la suddetta classe 
/*
function loadImage(){
	//Debug
	//alert('loadImage ');
		
	var imagesToLoad = $("#photosx").find(".preload");
    var imagesToLoadCount = imagesToLoad.size();
						
	var checkIfLoadedTimer = 
		setInterval(
			function () {
				//alert('a');
				if (!imagesToLoadCount) {
					clearInterval(checkIfLoadedTimer);
				} else {
					imagesToLoad.filter(".preload").each(function () {
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
            $(imageToLoad).css({visibility: "visible"}).animate({opacity: 1}, 400, function () {
                $(imageToLoad).removeClass("preload");
            });
        };
}
*/