<script src="<?php echo get_template_directory_uri(); ?>/js/grid.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/torna-su.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightBox-image.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fake.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_grid.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_lightBox.css">

<?php 			
	$categoryName = "";
	$catId = htmlspecialchars($_GET["cat"]);		
	
	if($catId != null && $catId != ""){		
		$categoryName = get_the_category_by_ID( $catId );
	}
?>

<script type="text/javascript">
	//Settaggio di variabili fondamentali
	//var totalPage = <?php echo $wp_query->max_num_pages; ?>;
	//alert(totalPage+"-1");
	var urlSite = "<?php bloginfo('wpurl'); ?>";    	
	
	var isPhone = "<?php echo isPhone(); ?>";
	
	if(isPhone == "0"){
		var numDiv = <?php echo get_option('numero-colonne'); ?>;
		var widthCols = "<?php echo get_option('width-colonne'); ?>";
		var widthGridValue = "<?php echo get_option('width-grid'); ?>";
		var marginImageValue = "<?php echo get_option('margin-image'); ?>";
	}else{
		var numDiv = "1";		
		var widthCols = "100";		
		var widthGridValue = "95";
		var marginImageValue = "5";		
	}
	
	var category = "<?php echo $categoryName?>";
</script>

<!--Contenitore Grid-->
<div id="photosx"></div>			

<?php 
	if(isPhone() == 0){ ?>
			
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
	}?>
