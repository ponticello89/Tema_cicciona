<?php 
	$arrayQueryPost = array();						
	$arrayQueryPost['post_status'] = 'publish';		
	$catId 		  = htmlspecialchars($_GET["cat"]);		
	$page	 	  = htmlspecialchars($_GET["paged"]);	
	if($catId != null && $catId != "" ){		
		$arrayQueryPost['cat'] = $catId;				
	}
	if($page != null && $page != "" ){		
		$arrayQueryPost['paged'] = $page;		
	}	
			
	query_posts($arrayQueryPost);			
	?>

	<?php	
	while ( have_posts() ) {
		the_post();
		$titleArticle = get_the_title($post->ID);			
		$urlArticle   = get_permalink($post->ID);
		$thumb 		  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
		//$thumb      = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );			
		//$thumb      = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'medium'), 'thumbnail_size' );
		$urlImage 	  = $thumb['0']; 
		$width 		  = $thumb['1'];
		$height 	  = $thumb['2'];			
	?>	
		
			<div class='imageCella'>				
				<a href='<?php echo $urlArticle ?>'>
					<img src='<?php echo $urlImage?>' class='preload image image1' id='img<?php echo $totaleImg?>' alt='Ofatalee <?php echo $titleArticle ?>'></img>
				</a>						
			</div>		
	<?php 
	}
	?>