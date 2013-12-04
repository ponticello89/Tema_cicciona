<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
		
	<div class="ciccio">
		
		<?php get_template_part( 'includes/loop_single' , 'single'); ?>
		
	</div>
	
	<div id="content" class="list-post">
												
		<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:','themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

		<?php // get post-nav.php (next/prev post link) ?>


		<?php  //get comment template (comments.php) ?>
		<?php //comments_template(); ?>
			
	</div>
	<!-- /#content -->

<?php endwhile; ?>

<?php //get_sidebar(); ?>
	
<?php get_footer(); ?>