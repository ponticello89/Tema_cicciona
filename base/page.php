<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_page.css">

<?php get_header(); ?>

	<div class="pageContent">
	
		<?php while ( have_posts() ) : the_post(); ?>
						
			<h1 class="page-title"><?php the_title(); ?></h1>

			<?php the_content(); ?>
					
		<?php endwhile; ?>
		
	</div>
	<!-- /#content -->
			
<?php get_footer(); ?>