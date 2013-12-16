<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/single.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_article.css">

<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
	
<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<div>
							
	<?php 
		$titleArticle = get_the_title($post->ID); 
		//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$urlImage = $thumb['0']; 
		$width = $thumb['1'];
		$height = $thumb['2'];	
				
	?>
	
	<script type="text/javascript">
		initializeDimension("<?php echo $width?>","<?php echo $height?>");		
	</script>
	
	<div class="test">
		<div class="imgDiv">
			<div class="leftDiv" onclick="location.href='<?php get_template_part( 'includes/nav_next'); ?>'">								
				<p class="leftArrowP">
					<a>
						<img src="<?php bloginfo('template_directory'); ?>/images/arrow-left.png" class="leftArrowImg" />
					</a	
				</p>
			</div>
			<div class="rightDiv" onclick="location.href='<?php get_template_part( 'includes/nav_previous'); ?>'"/>				
				<p class="rightArrowP">
					<a>
						<img src="<?php bloginfo('template_directory'); ?>/images/arrow-right.png" class="rightArrowImg"/>
					</a>
				</p>
			</div>			
			<img src='<?php echo $urlImage ?>' class='preload imageArticle' id='img' style="width: 0px; visibility: hidden; opacity: 0;"/>									
		<div>
	</div>
	
	<script type="text/javascript">
		loadImage(".test", ".preload", "1");				
	</script>
	
	<!--<img src="img" width="16" height="16" border="0" alt="Share" />-->	
	
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style addthis_32x32_style socialDiv">	                                 
	<a class="addthis_button_facebook"></a>	
	<a class="addthis_button_twitter"></a>		
	<a class="addthis_button_google_plusone_share"></a>
	<a class="addthis_button_tumblr"></a>
	</div>
	<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52af59c078a11b97"></script>
	<!-- AddThis Button END -->
	
	<?php the_content(); ?>
	
</div>						


