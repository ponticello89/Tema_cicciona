<?php 
	//Include funzioni di utilità
	require_once (TEMPLATEPATH . '/includes/utility.php'); 			
?>

<?php while (have_posts()) : the_post(); ?>
	
	<?php if (has_post_thumbnail()==1):  $i++; ?>
						
		<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
				
		<?php 			
			$urlArticle = get_permalink($post->ID);
		
			if($category_id != null && $category_id != "" ){
				$urlArticle = $urlArticle . '&cat='. $category_id;
			}
			
			$titleArticle = get_the_title($post->ID);			
			$thumb 		  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			$urlImage 	  = $thumb['0']; 
			$width 		  = $thumb['1'];
			$height 	  = $thumb['2'];													
		?>

		<?php if($width != null || $width!=0) :?>
			
			<li class="is-loading">		
				<?php 
				if(!isPhone()){
				?>
					<a onclick="apriImg_v2('<?php echo $urlArticle ?>', '<?php echo $paged;?>', '<?php echo $category_id;?>', '<?php echo $post->ID ?>')" >
				<?php 
				} else {
				?>
					<a href="<?php echo $urlArticle ?>">
				<?php 
				} 
				?>
					<img src="<?php echo $urlImage ?>" id="img<?php echo $post->ID ?>" alt="Ofatalee <?php echo $titleArticle ?>">
				</a>
			</li>
						
		<?php endif; ?>		
		
	<?php endif; ?>		
						
<?php endwhile; ?>