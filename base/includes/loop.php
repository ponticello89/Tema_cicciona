
<?php while (have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()==1):  $i++; ?>

		<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
			
				<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
				
				<div class="image">
					
					
					<img 	src="<?php echo $url; ?>" alt="ciccio<?php echo $i; ?>" 
								class="attachment-post-thumbnail wp-post-image">						
					</img>
					
					<div class="color">
					</div>		
					
					
					<!--			
					<div class="mask"></div>			
					<div class="content">
						<h2>Hover Style #2</h2>
						<p>Some description</p>
						<a href="<?php the_permalink(); ?>" class="info">Read More</a>
					</div>						
					-->
				</div>						
		</article>
	<?php endif; ?>		
						
<?php endwhile; ?>