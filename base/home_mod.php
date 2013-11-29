<script type="text/javascript">
    jQuery(document).ready(function($) {
        var count = 2;
        var total = <?php echo $wp_query->max_num_pages; ?>;
		imgArray=new Array();
		
		//Paginazione 1 chiamata durante il caricamento della pagina
		$(document).ready(					
			function () {
				loadArticle(1);								
			}			
		);
		
		
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
		
		//Funzione che restituisce la pagina degli articoli e la appende nel div
        function loadArticle(pageNumber){
			//Debug
			//alert('loadArticle('+pageNumber+')');
			
			$('a.inifiniteLoader').show('fast');
			$.ajax({
				url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
				type:'POST',
				data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=includes/loop_home', 
				success: function(html){           						
					$('a.inifiniteLoader').hide('1000');
					$("#photosx").append(html);    // This will be the div where our content will be loaded											
					loadImage();
					
					loadArticleTotalPage();
				}
			});					            			
			
			return false;
        }
		
		function loadArticleTotalPage(){			
			if(document.body.clientHeight < $(window).height()){					
				if (count > total){
					return false;
				}else{						
					loadArticle(count);
					count++;
				}			   			
			}
		}
		
		//Comparsa del pulsante torna su dopo un determinato scorrimento verso il basso
		$(window).scroll(function(){
            if ($(this).scrollTop() > 300) {
                $('.tornaSu').fadeIn();
            } else {
                $('.tornaSu').fadeOut();
            }
        });
		
		//Torna su con animazione a scorrimento lenta
		$('.tornaSu').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 'slow');
            return false;
        });
		
		$('.sfondoBigImage').click(function(){		
			$('.sfondoBigImage').fadeOut('fast');			
			$('.bigImage').fadeOut('fast');
		});
    });
	
	//Funzione che si occupa di collocare l'articolo nel div giusto
	var divNumber = 1;
	var totaleImg = 0;	
	function loadPhotoOnDiv(html){
		//Debug
		//alert('loadPhotoOnDiv(html) totaleImg = '+totaleImg+' size = '+width+'x'+height);
			
		//Appende HTML immagine nelle colonne 
		$("#colonna"+divNumber).append(html);	
				
		totaleImg++;
		
		//Calcola collocamento nelle colonne
		if(divNumber==4){
			divNumber=0;
		}
		divNumber++;						
	}
			
	//Calcola la grandezza del div che contiene l'immagine e della maschera in base all'immagine
	function reSizeDivImage(){
		//Debug
		//alert('reSizeDivImage totaleImg = '+totaleImg);
			
		for(i=0; i<totaleImg; i++){
			//Calcolo dei div in base all'immagine			
			var widthImage = document.getElementById('imgW'+i).value;			
			var heightImage = document.getElementById('imgH'+i).value;			
			var widthImageCella = $("#imageCella"+i).width();
			
			var parametro = widthImage/widthImageCella;
			var heightImageCella = heightImage/parametro;
			
			$("#imageCella"+i).height(heightImageCella);
			$("#img"+i).width(widthImageCella);
			$("#img"+i).height(heightImageCella);
			$("#mask"+i).height(heightImageCella*2);
			$("#mask"+i).width(widthImageCella*2);			
		}		
	}
	
	function loadArray(numImage, urlImage){
		//alert("loadArray"+urlArticle);		
		imgArray = imgArray.concat(totaleImg, urlImage);
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
				//$('#img_holder'+numImage).removeClass('loadit');			
				$(this).fadeIn('slow');			
			});			
		}
		
		//pulisce array
		imgArray=new Array();		
	}
	
	function apriImg(urlImage){		
		//alert(urlImage);
		$('.sfondoBigImage').fadeIn('slow');
		$('.bigImage').attr('src',urlImage);
		$('.bigImage').fadeIn('slow');
	}
	
</script>

<div id="photosx">			
	<div id="colonna1" class="colonnaPhoto">
	</div>
	<div id="colonna2" class="colonnaPhoto">
	</div>
	<div id="colonna3" class="colonnaPhoto">
	</div>
	<div id="colonna4" class="colonnaPhoto">
</div>				

<div 	class="sfondoBigImage" 
		style="	width: 100%; 
				height: 100%; 
				display: none;
				position: fixed;
				top: 0px;
				left: 0px;
				z-index: 9999;
				background-color: black;				
				opacity: 0.8;">							
</div>

<img 	class="bigImage" 
		style="	position: absolute;
				display: none;
				z-index: 10000;
				position: fixed;
				width: auto;
				top: 0;
				left: 0;
				height: 80%;" 
		src="http://localhost/wordpress/wp-content/uploads/2013/11/12658605-graffiti.jpg">
</img>		
