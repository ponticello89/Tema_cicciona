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

//Inizializzazione Griglia
var   $tiles    = $('#tiles');
var   $handler  = $('li', $tiles);
var   $main     = $('#main');
var   $window   = $(window);
var   $document = $(document);
var	  itemWidth = 320;
var   options   = {
	autoResize: true,  		 // This will auto-update the layout when the browser window is resized.
	container: 	$main, 		 // Optional, used for some extra CSS styling
	offset: 	12,    		 // Optional, the distance between grid items
	itemWidth:  itemWidth    // Optional, the width of a grid item
};

//Funzioni che partono al caricamento della pagina
jQuery(document).ready(function($) {	
	
	var paginaCarica = false;
	$(window).load(function () {
		paginaCarica = true;				
	});
		
	//Funzioni che partono al caricamento della pagina
	$(document).ready(					
		function () {		
		
			var checkIfLoadedTimer = 
				setInterval(
					function () {
						applyLayout()
					}, 
				300);
		
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
			
			//$("html, body").animate({ scrollTop: 1 }, 1);
			
			if(pageUp >= 1 && paginaCarica){						
				$('.overTheTop').stop();
				$('.overTheTop').animate({	
					"height": "44px"}, 
					700, 
					function () {								
						var caricato = loadArticle(pageUp, "up");				
						if(caricato){
							pageUp--;																				
						}	
						stopCaricamentoUp = 
							setTimeout(
								function(){
									clearTimeout(startCaricamentoUp); 
									$('.overTheTop').stop();
									$('.overTheTop').animate({	
										"height": "0px"}, 
										500
									);	
									$("html, body").animate({ scrollTop: 1 }, 1);										
								},600); 	
					});	
			}									
		} 
		if ($(window).scrollTop()>0){
			
			if ($(".overTheTop").is(':animated')){
				$('.overTheTop').stop();
				$('.overTheTop').animate({	
						"height": "0px"}, 
						500
				);	
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
		
		if(where=="down"){		
			if(!$('a.inifiniteLoaderDown').is(":visible")){					
				$('a.inifiniteLoaderDown').fadeIn('fast');					
			}
		}else if(where=="up"){
			if(!$('a.inifiniteLoaderUp').is(":visible")){					
				$('a.inifiniteLoaderUp').fadeIn('fast');
			}
		}
		
		$.ajax({		
			url: urlSite+"/wp-admin/admin-ajax.php",		
			type:'POST',			
			data: 'action=infinite_scroll&page_no='+ pageNumber + '&where='+ where + '&category_id='+category_id+'&loop_file=includes/loop_home', 
			success: function(html){  
				if(where=="down"){			
					$("#tiles").append(html);
				}else if(where=="up"){
					$("#tiles").prepend(html);
				}
				applyLayout();
				$tiles.imagesLoaded().progress(onProgress);
			},
			complete: function(){				
				load = "false";		
				
				//Gestione del Load Multi Page
				if(pageMulti!= null && pageMulti!= ""){
					loadArticle(pageMulti, "down");
				}else{
					loadArticleForScroll();			
				}
				
				//rompe il js ma de logica ci siamo
				if(pageNumber==pageRequest){					
					if ($('#img'+imageRequest).length){
						var scrollHeight = parseInt($('#img'+imageRequest).offset().top);
						$("html, body").animate({ scrollTop: scrollHeight }, 'slow');
					}					
				}
			}
		});				
		return true;	
	}	
	return false;
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

function applyLayout() {
		
	// Destroy the old handler
	if ($handler.wookmarkInstance) {
		$handler.wookmarkInstance.clear();
	}
		
	// Create a new layout handler.
	$handler = $('li', $tiles);			
	$handler.wookmark(options);
	
}

function onProgress( imgLoad, image ) {	
	// change class if the image is loaded or broken
	var $item = $( image.img ).parents("li");
	$item.removeClass('is-loading');  
}