<?php get_header(); ?>		

	<div id="content_home" class="clearfix">
					
		<?php if (have_posts()) : ?>
			
			<div id="photosx">			
				<div id="colonna1" class="colonnaPhoto">
				</div>
				<div id="colonna2" class="colonnaPhoto">
				</div>
				<div id="colonna3" class="colonnaPhoto">
				</div>
				<div id="colonna4" class="colonnaPhoto">
				</div>
				<?php// get_template_part( 'includes/loop' , 'index'); ?>										
			</div>
														
		<?php else : ?>
	
			<p><?php _e( 'Sorry, nothing found.', 'themify' ); ?></p>
	
		<?php endif; ?>			
	
	</div>
	
<?php get_footer(); ?>