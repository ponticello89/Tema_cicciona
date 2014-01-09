<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
		
	<div class="ciccio">
		<!-- #content -->
		<?php get_template_part( 'includes/loop_single' , 'single'); ?>
		
	</div>
		
<?php endwhile; ?>
	
<?php get_footer(); ?>