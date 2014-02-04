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

<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/torna-su.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightBox-image.js"></script>

<div class="loading">
	<a class="inifiniteLoaderUp">
		<img src="<?php bloginfo('template_directory'); ?>/images/loading.gif">
	</a>	
</div>

<!--Contenitore Grid
<div id="photosx"></div>			
-->

 <!-- CSS Reset -->  
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/reset_grid.css">

  <!-- Specific CSS for the tiles -->  
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_grid2.css">
  
  <!-- Global CSS for the page and tiles -->  
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/main_grid.css">

<div id="main" role="main">
	<ul id="tiles">              
    </ul>
</div>

<!-- include jQuery -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>

  <!-- Include the imagesLoaded plug-in -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.imagesloaded.js"></script>
  
  <!-- Include the plug-in -->
  <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.wookmark.js"></script>

<script type="text/javascript">
	
  </script>


<?php 
	if(!isPhone()){ ?>
		<script src="<?php echo get_template_directory_uri(); ?>/js/grid.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_grid.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_lightBox.css">
<?php 
	}else{?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_grid_mobile.css">
<?php 
	}?>
