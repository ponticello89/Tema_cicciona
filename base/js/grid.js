//Javascript che si occupa della creazione della tabella

//Contatore delle immagini inserite
var totaleImg = 0;
//Contatore delle pagine contenenti immagini inserite
//var countPage = 1;

//var currentPage;
var pageUp;
var pageDown;

var numberMultiPage = 1;

//var wherePage = "down";

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
			createDiv(numDiv);		
			reSize(numDiv, widthCols);		
							
			if(pageRequest==1){				
				pageDown = pageRequest;				
				var caricato = loadArticle(pageDown, "down");	
				if(caricato){
					pageDown++;						
				}
			}else if(pageRequest>1){
								
				pageUp = pageRequest-numberMultiPage;
				pageDown = pageRequest;
				
				if(pageUp<1){
					pageUp = 1;
				}
												
				var cont = pageUp;
				var pagesRequest = "";
				
				while(cont <= pageRequest){					
					pagesRequest = pagesRequest+cont+",";
					cont++;
				}
								
				pagesRequest = pagesRequest.substr(0, pagesRequest.length-1);												
								
				var caricato = loadArticle(pagesRequest, "down");	
				if(caricato){		
					pageUp--;
					pageDown++;					
				}								
			}
			//Caricamento della prima pagina di immagini									
		}							
	)
	
	var startCaricamentoUp;
	//Attivazione paginazione dopo scorrimento fino a fine pagina
	$(window).scroll(function(){						
		if  ($(window).scrollTop() > $(document).height() - ($(window).height()*2)){		
			if (finishImage=="true"){
				return false;
			}else{										
				var caricato = loadArticle(pageDown, "down");				
				if(caricato){
					pageDown++;
				}
		    }			   
		}
		
		if ($(window).scrollTop()==0){
			if(pageUp >= 1){				
				startCaricamentoUp = 
					setTimeout(
						function(){
							var caricato = loadArticle(pageUp, "up");				
							if(caricato){
								pageUp--;								
								$("html, body").animate({ scrollTop: 1 }, 'slow');
							}							
						},1000); 
			}
		} 
		if ($(window).scrollTop()>0){ 			
			clearTimeout(startCaricamentoUp); 
		}
		
	});		
	
	$(window).resize(function () {		
		reSize(numDiv, widthCols);		
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
function loadArticle(pageNumber, where){
	//Debug
	//alert('loadArticle('+category+')');	
	
	//Gestione del Load Multi Page
	pageNumber = pageNumber+"";
	var pageMulti;
	if(pageNumber.indexOf(",") != -1){		
		pageMulti = pageNumber;		
		pageNumber = pageNumber.substr(0, pageNumber.indexOf(',')); 		
		pageMulti = pageMulti.substr(pageMulti.indexOf(',')+1); 				
	}		
		
	if(load == "false"){		
		load = "true";	
				
		$.ajax({		
			url: urlSite+"/wp-admin/admin-ajax.php",		
			type:'POST',			
			//data: 'action=infinite_scroll&page_no='+ pageNumber + '&where='+ where + '&category_name='+category_name+'&category_id='+category_id+'&loop_file=includes/loop_home', 
			data: 'action=infinite_scroll&page_no='+ pageNumber + '&where='+ where + '&category_id='+category_id+'&loop_file=includes/loop_home', 
			success: function(html){           											
				$("#photosx").append(html);    // This will be the div where our content will be loaded																					
			},
			complete: function(){				
				load = "false";		
												
				//Settaggio dei margini delle immagini
				setMarginImage(marginImageValue);
				if(isPhone == "0"){
					loadImage("#photosx", ".preload", "0.7");		
				}else{
					loadImage("#photosx", ".preload", "1");		
				}
				
				//Gestione del Load Multi Page
				if(pageMulti!= null && pageMulti!= ""){
					loadArticle(pageMulti, "down");
				}else{
					loadArticleForScroll();			
				}
				
				//rompe il js ma de logica ci siamo
				if(pageNumber==pageRequest){					
					var scrollHeight = parseInt($('#imageCella'+imageRequest).offset().top);
					$("html, body").animate({ scrollTop: scrollHeight }, 'slow');
				}
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
function createDiv(numDiv){

	for (i=1; i<=numDiv; i++) {
		//Creo il div colonna
		var divHtml = "<div id=\"colonna"+i+"\" class=\"colonna colonnaPhoto\">";		
		
		//Lo appendo
		$("#photosx").append(divHtml);
				
		//Inizializzo l'array height con valore 0
		heightColArray [i] = 0;		
	}		
}
function reSize(numDiv, widthCols){
	var widthColsArray = widthCols.split(",");
					
	$(".imageCella").css({height : ""});					
	
	for (i=1; i<=numDiv; i++) {
		//Creo il div colonna		
		$("#colonna"+[i]).css({width : ((widthColsArray[(i-1)])-1)+"%"});
		$("#colonna"+i).width(parseInt($("#colonna"+i).width()));
							
		//Inizializzo l'array height con valore 0
		heightColArray [i] = 0;		
	}		
}
function createDiv_(numDiv, widthCols){
	
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
}

//Funzione che controlla se l'insieme delle immagini stampate attivino lo scroll
function loadArticleForScroll(){			
	if($(body).height() <= $(window).height()){							
		if (finishImage=='true'){
			return false;
		}else{			
			var caricato = loadArticle(pageDown, "down");	
			if(caricato){				
				pageDown++;			
			}
		}			   			
	}
	
}

var firstLoad = true;
//Funzione che si occupa di collocare l'articolo nel div giusto
function loadPhotoOnDiv(html, widthImage, heightImage, where, idArticle){
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

		if(where=="down"){
			//Appende HTML immagine nelle colonne 
			$("#colonna"+divSelect).append(html);
		}else if(where=="up"){
			//Appende HTML immagine nelle colonne 
			$("#colonna"+divSelect).prepend(html);
		}
		
		//Setto nell'array le grandezze delle colonne per calcolare il collocamento
		var widthColonna = $("#colonna"+divSelect).width();
		
		var x = (widthImage/widthColonna);		
		heightImage = heightImage/x;
		$("#imageCella"+idArticle).height(parseInt(heightImage));				
		heightColArray [divSelect] = parseInt(heightColArray [divSelect]) + parseInt(heightImage);
		
		totaleImg++;
	}
}


function apriImg_v2(urlArticle, page, category, idArticle){	
	homeUrl = window.location+"";
	
	if(homeUrl.indexOf("page=")!=-1){
		homeUrl = homeUrl.replace(homeUrl.substr((homeUrl.indexOf('page=')-1)), "");
	}	
	if(homeUrl.indexOf("?")!=-1){
		if(category == null || category == ""){
			window.history.pushState(homeUrl,'',homeUrl+'&page='+page+'&image='+idArticle);
		}else{
			window.history.pushState(homeUrl,'',homeUrl+'&page='+page+'&image='+idArticle+'&cat='+category);
		}	
	}else{
		if(category == null || category == ""){
			window.history.pushState(homeUrl,'',homeUrl+'?page='+page+'&image='+idArticle);		
		}else{
			window.history.pushState(homeUrl,'',homeUrl+'?page='+page+'&image='+idArticle+'&cat='+category);		
		}
	}
	
	window.location.href = urlArticle;		
}
	