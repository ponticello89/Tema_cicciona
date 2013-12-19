<?php get_header(); ?>		

	<div id="content_home" class="clearfix">
		
		<?php if (have_posts()) : ?>
			<?php if(is_home() || is_category()) : ?>					
				<?php get_template_part( 'home_mod' , 'home'); ?>		
			<?php endif; ?>					
		<?php else : ?>
	
			<p><?php _e( 'Sorry, nothing found.'); ?></p>
	
		<?php endif; ?>			
	
	</div>
	
<?php get_footer(); ?>