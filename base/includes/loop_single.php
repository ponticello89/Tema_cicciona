<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/single.js"></script>

<?php $catId = htmlspecialchars($_GET["cat"]); ?>

<?php 
	if(!isPhone()){
?>
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_article.css">
<?php 
	}else{
?>	
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_article_mobile.css">
<?php 
	}
?>	

<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
	
<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
<div>
							
	<?php 
		$idArticle = $post->ID;
		$titleArticle = get_the_title($post->ID); 
		//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
		$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
		$urlImage = $thumb['0']; 
		$width = $thumb['1'];
		$height = $thumb['2'];	
		
		$nextArticleUrl = null;
		$prevArticleUrl = null;
		$next_post = getNextArticleOfCategory($idArticle, $catId);		
		$prev_post = getPrevArticleOfCategory($idArticle, $catId);
		if($next_post != null){
			$nextArticleUrl = get_permalink($next_post);
			if($catId != null && $catId != "" ){
				$nextArticleUrl = $nextArticleUrl . "&cat=" . $catId;
			}
		}
		if($prev_post != null){
			$prevArticleUrl = get_permalink($prev_post);
			if($catId != null && $catId != "" ){
				$prevArticleUrl = $prevArticleUrl . "&cat=" . $catId;
			}
		}
	?>
	
	<script type="text/javascript">
		initializeDimension("<?php echo $width?>","<?php echo $height?>");		
	</script>
	
	<div class="titleArticleDiv">
		<p class="titleArticleP">
			<?php echo get_the_title($idArticle); ?> 
		</p>
	</div>
	
	<?php if (has_post_thumbnail()==1){ ?>
		<div class="test">		
			<div class="imgDiv">
				<!-- IMAGE -->			
				<!-- NAVIGATION -->			
				<?php if($prevArticleUrl != null && $prevArticleUrl != ""){ ?>
					<div class="leftDiv" onclick="location.href='<?php echo $prevArticleUrl; ?>'">								
						<p class="leftArrowP">
							<a>
								<img src="<?php bloginfo('template_directory'); ?>/images/arrow-left.png" class="leftArrowImg subPreLoad" style="opacity: 0;" />
							</a	
						</p>
					</div>
				<?php } ?>
				<?php if($nextArticleUrl != null && $nextArticleUrl != ""){ ?>
					<div class="rightDiv" onclick="location.href='<?php echo $nextArticleUrl; ?>'"/>				
						<p class="rightArrowP">
							<a>
								<img src="<?php bloginfo('template_directory'); ?>/images/arrow-right.png" class="rightArrowImg subPreLoad" style="opacity: 0;"/>
							</a>
						</p>
					</div>		
				<?php } ?>		
				<!-- NAVIGATION -->						
				<img src='<?php echo $urlImage ?>' class='preload imageArticle' id='img' style="width: 0px; visibility: hidden; opacity: 0;"/>											
			
				<script type="text/javascript">
					loadImage(".test", ".preload", "1", ".subPreLoad");				
				</script>
				<!-- IMAGE -->			
				
				<!-- SOCIAL-->			
				<?php 
					if(!isPhone()){
						require_once (TEMPLATEPATH . '/includes/social.php');
					}else{
						require_once (TEMPLATEPATH . '/includes/social_mobile.php');
					}
				?>
				<!-- SOCIAL-->			
				
				<!-- HOME BUTTON-->
				<?php 
					$homeUrl 	   = get_option('home');				
					$pageArticle   = getPageOfArticle($idArticle, $catId);
					$returnHomeUrl = $homeUrl . '?page=' . $pageArticle . '&image=' . $idArticle;
					if($catId != null && $catId != "" ){
						$returnHomeUrl = $returnHomeUrl . '&cat=' . $catId;
					}
				?>			
				
				<div class="returnMenuDiv">
					<ul class="menuUl">
						<li class="socialLi">
							<a href="<?php echo $returnHomeUrl?>">
								<p class="socialP menuBtn"></p>					
							</a>	
						</li>
					</ul>
				</div>
				<!-- HOME BUTTON-->
				
			</div>
		</div>
	<?php } ?>
	
	<div class="contentArticleDiv">
		<p class="contentArticleP">
			<?php the_content(); ?>
		</p>
	</div>
	
</div>						


