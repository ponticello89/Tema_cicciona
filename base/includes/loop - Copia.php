
<?php while (have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()==1):  $i++; ?>

		<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
			
		<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		
		
		<script type="text/javascript">	
			alert("<div class='image'><img 	src='"+<?php echo $url; ?>+"' alt='ciccio"+<?php echo $i; ?>+" class='attachment-post-thumbnail wp-post-image'></img><div class='color'></div></div>");
			loadPhotoOnDiv("<div class='image'><img 	src='"+<?php echo $url; ?>+"' alt='ciccio"+<?php echo $i; ?>+" class='attachment-post-thumbnail wp-post-image'></img><div class='color'></div></div>");
		</script>

		<?php/*?>
		<div class="image">
						
			<img 	src="<?php echo $url; ?>" alt="ciccio<?php echo $i; ?>" 
						class="attachment-post-thumbnail wp-post-image">						
			</img>
			
			<div class="color">
			</div>		
			
		</div>						
		-->
		<?php*/?>
	<?php endif; ?>		
						
<?php endwhile; ?>