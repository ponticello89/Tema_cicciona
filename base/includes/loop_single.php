<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/single.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_article.css">

<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
	
<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<div>
							
	<?php 
		$titleArticle = get_the_title($post->ID); 
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
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
		reSizeImageArticle();		
	</script>
	
	<!--SOCIAL -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/it_IT/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	
	<div class="fb-share-button" data-href="<?php echo the_permalink() ?>" data-width="60x60" data-type="icon"></div>		
	
	<a 	href="http://www.tumblr.com/share/photo?source=<?php echo urlencode($urlImage) ?>&clickthru=<?php echo urlencode(the_permalink()) ?>" 
		title="Share on Tumblr" 
		style="display:inline-block; text-indent:-9999px; overflow:hidden; width:20px; height:20px; background:url('http://platform.tumblr.com/v1/share_4.png') top left no-repeat transparent;">
			Share on Tumblr
	</a>
	
	<!-- Inserisci questo tag nel punto in cui vuoi che sia visualizzato l'elemento pulsante +1. -->
	<div class="g-plusone" data-size="medium" data-annotation="none"></div>

	<!-- Inserisci questo tag dopo l'ultimo tag di pulsante +1. -->
	<script type="text/javascript">
	  window.___gcfg = {lang: 'it'};

	  (function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/platform.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script>
	<!--SOCIAL -->
			
	<?php the_content(); ?>
	
</div>						


