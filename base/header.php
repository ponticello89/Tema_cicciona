<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo bloginfo('rss2_url'); ?>">

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/media-queries.css">

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style_grid.css">


<!--
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/demo.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style_common.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/reset.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style2.css">
-->

<!-- respond.js (add media query support for IE) -->
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
<![endif]-->

<!-- html5.js (HTML5 Shiv for IE) -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- wp_header -->
<?php wp_head(); ?>

<?php // include theme.script.js  ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/theme.script.js"></script>

<?php // enqueue comment-reply.js (require for threaded comments)
	if ( is_singular() && get_option( 'thread_comments' ) )	wp_enqueue_script( 'comment-reply' ); 
?>

<!-- start infinite scroll function  -->
<?php if (!is_single() || !is_page()): ?>
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
				data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=includes/loop', 
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
		//alert("loadArray"+urlImage);
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
				//alert('load .img'+numImage);
				$(this).hide();
				//$('#img_holder'+numImage).removeClass('loadit');			
				$(this).fadeIn('slow');			
			});
			/*
			var _img = document.getElementById('img'+numImage);
			alert(_img+"-"+numImage);
			var newImg = new Image;
			newImg.src = urlImage;
			newImg.onload = function() {
				alert('loadImage ');
				_img.src = this.src;
				//$(newImg).fadeIn('slow');
			}
			*/
		}
		
		imgArray=new Array();
		//var img = new Image();		
		//$(img).load(function(){
		/*
		$('#img'+numImage).load(function(){
			alert('load .img'+numImage);
			$(this).hide();
			$('#img_holder'+numImage).removeClass('loadit');			
			$(this).fadeIn('slow');			
		});
		*/
	}
</script>
<?php endif; ?>	
<!-- end infinite scroll pagination -->

</head>

<body <?php body_class($class); ?>>

<div id="pagewrap">

	<header id="header" class="pagewidth">

		<hgroup>
			<h1 id="site-logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<h2 id="site-description"><?php bloginfo('description'); ?></h2>
		</hgroup>

		<?php // main navigation ?>
		<nav id="main-nav-wrap">
			<?php wp_nav_menu(array('theme_location' => 'main-nav' , 'fallback_cb' => 'default_main_nav' , 'container'  => '' , 'menu_id' => 'main-nav' , 'menu_class' => 'main-nav')); ?>
		</nav>

		<?php // get searchform.php ?>
		<div id="searchform-wrap">
			<?php get_search_form(); ?>
		</div>

		<div class="social-widget">
			<div class="rss"><a href="<?php echo bloginfo('rss2_url'); ?>">RSS</a></div>
		</div>
		<!-- /.social-widget -->

	</header>
	<!-- /#header -->

	<div id="body" class="pagewidth clearfix">