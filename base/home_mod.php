<?php 			
	$categoryName = "";
	$catId 		  = htmlspecialchars($_GET["cat"]);		
	$pageUrl 	  = htmlspecialchars($_GET["page"]);		
	$imageUrl 	  = htmlspecialchars($_GET["image"]);		
	
	if($catId != null && $catId != ""){		
		$categoryName = get_the_category_by_ID( $catId );
	}
?>

<script type="text/javascript">
	//Settaggio di variabili fondamentali
	//var totalPage = <?php echo $wp_query->max_num_pages; ?>;
	//alert(totalPage+"-1");
	var urlSite = "<?php bloginfo('wpurl'); ?>";    	
	
	if(isPhone == "0"){
		var numDiv 			 = 	"<?php echo get_option('numero-colonne'); ?>";
		var widthCols 		 = 	"<?php echo get_option('width-colonne'); ?>";
		var widthGridValue 	 =	"<?php echo get_option('width-grid'); ?>";
		var marginImageValue = 	"<?php echo get_option('margin-image'); ?>";
	}else{
		var numDiv 			 = 	"1";		
		var widthCols 		 = 	"100";		
		var widthGridValue 	 = 	"95";
		var marginImageValue =  "<?php echo get_option('margin-image'); ?>";
	}
	
	var category_id   = "<?php echo $catId?>";
	var category_name = "<?php echo $categoryName?>";
	
	//Contatore delle pagine contenenti immagini inserite
	var pageRequest = "<?php echo $pageUrl?>";
	if(pageRequest == null || pageRequest == "" ){
		pageRequest = 1;
	}else{
		pageRequest = parseInt(pageRequest);
	}
	
	var imageRequest = "<?php echo $imageUrl?>";	
</script>

<script src="<?php echo get_template_directory_uri(); ?>/js/grid.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/torna-su.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightBox-image.js"></script>

<div class="loading">
	<a class="inifiniteLoaderUp">
		<img src="<?php bloginfo('template_directory'); ?>/images/loading.gif">
	</a>	
</div>
<!--Contenitore Grid-->
<div id="photosx"></div>			


<?php 
	//Gestione della home in base al metodo di visualizzazione PC/PHONE
	//Se PHONE tolgo:
	//	headerFake
	//	lightbox
	//	effetti su immagini
	
	if(!isPhone()){ ?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_grid.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_lightBox.css">
		<script src="<?php echo get_template_directory_uri(); ?>/js/header_fake.js"></script>
			
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
						height: 80%;">
		</img>
		<div 	class="titleBigImageDiv"
				style="	position: absolute;
						display: none;
						z-index: 10000;
						position: fixed;
						width: auto;
						top: 0;
						left: 0;
						height: 80%;
						background-color: black;				
						opacity: 0.8;">
						
			<h1 class="titleBigImage"/>
		</div>

		<p class="tornaSu">
			<a>
				<img src="<?php bloginfo('template_directory'); ?>/images/up-arrow-icon.png" />
			</a>
		</p>
<?php 
	}else{?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_grid_mobile.css">
<?php 
	}?>
