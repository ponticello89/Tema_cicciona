<script src="<?php echo get_template_directory_uri(); ?>/js/grid.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/torna-su.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/lightBox-image.js"></script>

<script type="text/javascript">
	//Settaggio di variabili fondamentali
	var total = <?php echo $wp_query->max_num_pages; ?>;
	var urlSite = "<?php bloginfo('wpurl'); ?>";    	
	
	var numDiv = <?php echo get_option('numero-colonne'); ?>;
	if(numDiv == null){
		numDiv = 3;
	}
	var widthCols = "<?php echo get_option('width-colonne'); ?>";
	if(widthCols == null){
		widthCols = "33,33,33";
	}
	
</script>

<!--Contenitore Grid-->
<div id="photosx"/>			
	
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
				display: block;
				z-index: 10000;
				position: fixed;
				width: auto;
				top: 0;
				left: 0;
				height: 80%;">
</img>
<div 	class="titleBigImage"
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
	<h1>
		titolo
	</h1>
</div>
