<?php get_header(); ?>		
		
	<div id="content_home" class="clearfix">
		
		<?php if (have_posts()) : ?>
			<?php if(is_home() || is_category()) : ?>				
				<?php 																
					get_template_part( 'home_mod' , 'home'); 				
				?>
					<noscript>	
				<?php
						get_template_part( 'includes/loop' , 'home'); 	
						get_template_part( 'includes/pagination');
				?>
					</noscript>				
			<?php endif; ?>					
		<?php else : ?>
	
			<p><?php _e( 'Sorry, nothing found.'); ?></p>
	
		<?php endif; ?>			
	
	</div>
	
<?php get_footer(); ?>
