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
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/demo.css">

<!--
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
		
        $(window).scroll(function(){
                if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                   if (count > total){
                   	  	return false;
                   }else{						
                   		loadArticle(count);						
                   }
                   count++;
                }
        }); 

        function loadArticle(pageNumber){
			//Debug
			//alert('loadArticle('+pageNumber+')');
			
			$('a#inifiniteLoader').show('fast');
			$.ajax({
				url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
				type:'POST',
				data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=includes/loop', 
				success: function(html){           						
					$('a#inifiniteLoader').hide('1000');
					$("#photosx").append(html);    // This will be the div where our content will be loaded						
				}
			});
            return false;
        }
		
		//Paginazione 1 chiamata durante il caricamento della pagina
		$(document).ready(
			function () {
				loadArticle(1);				
			}
		);
    });
	
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
	
	//Calcola la grandezza de div che contiene l'immagine e della maschera in base all'immagine
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
			$("#mask"+i).height(heightImageCella*2);
			$("#mask"+i).width(widthImageCella*2);
			
		}		
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