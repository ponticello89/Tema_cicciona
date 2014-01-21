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

	<!-- NAVIGATION -->			
	<?php if($prevArticleUrl != null && $prevArticleUrl != ""){ ?>
		<div class="leftDiv" onclick="location.href='<?php echo $prevArticleUrl; ?>'">								
			<p class="leftArrowP">
				<a>
					<img src="<?php bloginfo('template_directory'); ?>/images/arrow-left.png" class="leftArrowImg subPreLoad" style="opacity: 0.4;" />
				</a>	
			</p>
		</div>
	<?php } ?>
	<?php if($nextArticleUrl != null && $nextArticleUrl != ""){ ?>
		<div class="rightDiv" onclick="location.href='<?php echo $nextArticleUrl; ?>'"/>				
			<p class="rightArrowP">
				<a>
					<img src="<?php bloginfo('template_directory'); ?>/images/arrow-right.png" class="rightArrowImg subPreLoad" style="opacity: 0.4;"/>
				</a>
			</p>
		</div>		
	<?php } ?>		
	<!-- NAVIGATION -->	
	
	<!-- COPERTINA -->		
	<?php if (has_post_thumbnail()==1){ ?>
		<div class="test">		
			<div class="imgDiv">													
				<img src='<?php echo $urlImage ?>' class='preload imageArticle' id='img' style="visibility: hidden; opacity: 0;"/>														
				
				<!-- IMPAGINAZIONE -->		
				<?php 
				if(!isPhone()){
				?>
					<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.gridster.js" type="text/javascript" charset="utf-8"></script>
					<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.gridster.css">
					
					<script type="text/javascript">
						var gridster;

						$(function(){
						
							gridster = $(".gridster > ul").gridster({
								widget_margins: [5, 5],
								widget_base_dimensions: [20, 20],     					        								
								draggable: {
									handle: 'no'
								}
							}).data('gridster');			
						});			
					</script>
					
					<div class="gridster" style="width:960px;margin: auto;margin-top: 20px;">
						<ul style="list-style: none;">
							<?php echo get_post_meta($post->ID, 'pagination_image', true);?>
						 </ul>
					</div>
				<?php 
				}else{					
				?>											
					<script type="text/javascript">					 												
						var htmlString = '<?php echo trim (get_post_meta($post->ID, 'pagination_image', true)) ?>';																			
						var $elem = $('<div>').html(htmlString);
						var $img = $elem.find('img');						
						$('.imgDiv').append($img);					
					</script>					
				<?php 
				}
				?>
				
				<!-- IMPAGINAZIONE -->		
				
				<script type="text/javascript">
					loadImage(".test", ".preload", "1", ".subPreLoad", "");				
				</script>					
			</div>
		</div>
	<?php } ?>
	<!-- COPERTINA -->		
	
	<!-- CONTENT -->		
	<div class="contentArticleDiv">
		<p class="contentArticleP">
			<?php the_content(); ?>
		</p>
	</div>
	<!-- CONTENT -->		
	
	<div class="conteinerButtonBottom">
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
						<?php 
						if(!isPhone()){
						?>
							<p class="socialP menuBtn"></p>					
						<?php 
						}else{
						?>
							<p class="menuBtn"></p>
						<?php 
						}
						?>
					</a>	
				</li>
			</ul>
		</div>
		<!-- HOME BUTTON-->
	</div>
	
</div>						


