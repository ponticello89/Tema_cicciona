					
<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
	
		<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
		<div class="view view-second">
			
			<?php the_content(); ?>
						
			<!--
			<div class="content">
				<h2>Hover Style #2</h2>
				<p>Some description</p>
				<a href="<?php the_permalink(); ?>" class="info">Read More</a>
			</div>						
			-->
		</div>						


