<?php get_header(); ?>		

	<div id="content_home" class="clearfix">
		
		<?php // the loop ?>
		<?php //$home_query = new WP_Query( "cat=$slider_cat&ignore_sticky_posts=1&showposts=$top_row_posts" );?>
			
		<?php if (have_posts()) : ?>
			
			<section id="photos">
			
				<?php while (have_posts()) : the_post(); ?>
				
					<?php if (has_post_thumbnail()==1):  $i++; ?>
						<?php get_template_part( 'includes/loop' , 'index'); ?>
					<?php endif; ?>		
					
				<?php endwhile; ?>
			
			</section>
			
			<?php get_template_part( 'includes/pagination'); ?>
					
		<?php else : ?>
	
			<p><?php _e( 'Sorry, nothing found.', 'themify' ); ?></p>
	
		<?php endif; ?>			
	
	</div>
	<!-- /#content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>