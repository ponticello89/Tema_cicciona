<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.krioImageLoader.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>

<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
	
<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<div class="view view-second">
							
	<?php 
		$titleArticle = get_the_title($post->ID); 
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
		$urlImage = $thumb['0']; 
		$width = $thumb['1'];
		$height = $thumb['2'];	
				
	?>
	
	<script type="text/javascript">
		var widthWindow = $(window).width();
		var heightWindow = $(window).height();
		var widthImage = "<?php echo $width?>";
		var heightImage = "<?php echo $height?>";
		var x;
				
		//alert("ciccio");
		
		x = (heightImage/heightWindow);		
		if((widthImage/widthWindow) > x){
			x = (widthImage/widthWindow);
		}			
		
		if(x != 0){
			widthImage = widthImage/x;
			heightImage = heightImage/x;
		}
		
		widthImage 	= parseInt((widthImage/10)*8);
		heightImage = parseInt((heightImage/10)*8);
		
		var marginTop =  parseInt((heightWindow-heightImage)/2);
		var marginLeft = parseInt((widthWindow-widthImage)/2);
		
		$(function() {
			$('.imageArticle').css({	width:  widthImage,
										height: heightImage,
										//top: marginTop+"px",
										//left: marginLeft+"px"
										});
			
			$('.contenitoreImg').css({	width:  widthImage,
										height: heightImage,
										//top: marginTop+"px",
										left: marginLeft+"px",
										"position": "relative"});
										
			$('.leftImg').css({			width:  (widthImage/2),
										height: heightImage,
										//top: marginTop+"px",
										//left: marginLeft+"px",
										"position": "absolute"});
										
			$('.rightImg').css({		width:  (widthImage/2),
										height: heightImage,
										//top: marginTop+"px",
										left: (widthImage/2)+"px",
										"position": "absolute"});
		});				
	</script>
	
	<div class="test">
		<div class="contenitoreImg">
			<div class="leftImg">				
				<?php get_template_part( 'includes/nav_next'); ?>
			</div>
			<div class="rightImg"/>
				<?php get_template_part( 'includes/nav_previous'); ?>
			</div>			
			<img src='<?php echo $urlImage ?>' class='preload imageArticle' id='img' style="width: 0px; visibility: hidden; opacity: 0;"/>									
		<div>
	</div>
	
	<script type="text/javascript">
		loadImage(".test", ".preload");				
	</script>
	<?php the_content(); ?>
	
	<!--
	<div class="content">
		<h2>Hover Style #2</h2>
		<p>Some description</p>
		<a href="<?php the_permalink(); ?>" class="info">Read More</a>
	</div>						
	-->
</div>						


