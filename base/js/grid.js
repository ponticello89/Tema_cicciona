//Javascript che si occupa della creazione della tabella

//Contatore delle immagini inserite
var totaleImg = 0;
//Contatore delle pagine contenenti immagini inserite
var count = 1;
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
			//Creazione colonne
			createDiv(numDiv, widthCols);
			//Caricamento della prima pagina di immagini
			loadArticle(count);	
			count++;			
		}			
	)
	
	//Attivazione paginazione dopo scorrimento fino a fine pagina
	$(window).scroll(function(){
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
		   if (count > total){
				return false;
		   }else{						
				loadArticle(count);				
				count++;
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
function loadArticle(pageNumber){
	//Debug
	//alert('loadArticle('+urlSite+')');	
	$('a.inifiniteLoader').show('fast');
	$.ajax({		
		url: urlSite+"/wp-admin/admin-ajax.php",		
		type:'POST',
		data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=includes/loop_home', 
		success: function(html){           						
			$('a.inifiniteLoader').hide('1000');
			$("#photosx").append(html);    // This will be the div where our content will be loaded														
			loadImage();
			
			loadArticleForScroll();
		}
	});					            			
	
	return false;
}

//Funzione che crea i div-colonna che conterranno verticalmente le immagini
function createDiv(numDiv, widthCols){
	
	var widthColsArray = widthCols.split(",");
					
	for (i=1; i<=numDiv; i++) { 
		var divHtml;
		//if(i==numDiv){
			divHtml = "<div id=\"colonna"+i+"\" class=\"colonna colonnaPhotoFinal\">";
		//}else {
			divHtml = "<div id=\"colonna"+i+"\" style=\"width: "+((widthColsArray[(i-1)])-1)+"%;\" class=\"colonna colonnaPhoto\">";
		//}			
		$("#photosx").append(divHtml);	
		heightColArray [i] = 0;		
	}
}

//Funzione che controlla se l'insieme delle immagini stampate attivino lo scroll
function loadArticleForScroll(){			
	if(document.body.clientHeight < $(window).height()){					
		if (count > total){
			return false;
		}else{						
			loadArticle(count);	
			count++;			
		}			   			
	}
}

//Funzione che carica un array serve in fase di preload e settaggio dell'immagine nel contenitore
function loadArray(numImage, urlImage, widthImage, heightImage){
	//alert("loadArray"+urlArticle);		
	imgArray = imgArray.concat(totaleImg, urlImage, widthImage, heightImage);
}	

//Funzione che si occupa di collocare l'articolo nel div giusto
function loadPhotoOnDiv(html, widthImage, heightImage){
	//Debug
	//alert('loadPhotoOnDiv(html) totaleImg = '+totaleImg+' size = '+width+'x'+height);
	
	//Calcolo il collocamento
	var divSelect = 0;
	var heightMoreLittle = -1;
	for (i=numDiv; i>0; i--) {		
		//alert(heightColArray [i]+" - "+i);
		if(heightMoreLittle == -1){
			heightMoreLittle = heightColArray [i] ;
			divSelect = i;
		} else {
			if (heightMoreLittle >= heightColArray[i]){
				heightMoreLittle = heightColArray [i] ;
				divSelect = i;
			}
		}
	}
		
	//Appende HTML immagine nelle colonne 
	$("#colonna"+divSelect).append(html);
	
	//Setto nell'array le grandezze delle colonne per calcolare il collocamento
	var widthColonna = $("#colonna"+divSelect).width();
	var x = (widthImage/widthColonna);	
	heightImage = heightImage/x;		
	heightColArray [divSelect] = heightColArray [divSelect] + heightImage;
	
	totaleImg++;
}
	
//Funzione che si occupera del preload delle immagini	
function loadImage(){
	//Debug
	//alert('loadImage ');
		
	for (i=0; i<imgArray.length; i++) { 
		var numImage = imgArray[i];
		i++;
		var urlImage = imgArray[i];
				
		$('#img'+numImage).load(function(){							
			$(this).fadeIn('slow');			
			$(this).css({	visibility: "visible"});		
		});			
	}
	
	//pulisce array
	imgArray=new Array();		
}