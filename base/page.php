<?php get_header(); ?>

	<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_page.css">

	<div class="pageContent">
	
		<?php while ( have_posts() ) : the_post(); ?>
						
			<h1 class="page-title"><?php the_title(); ?></h1>

			<?php the_content(); ?>
					
		<?php endwhile; ?>
		
	</div>	
			
<?php get_footer(); ?>