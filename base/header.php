<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo bloginfo('rss2_url'); ?>">

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/media-queries.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_total.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_header.css">

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/header.js"></script>

<!-- wp_header -->
<?php wp_head(); ?>

<?php // include theme.script.js  ?>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/theme.script.js"></script>-->


<?php // enqueue comment-reply.js (require for threaded comments)
	if ( is_singular() && get_option( 'thread_comments' ) )	wp_enqueue_script( 'comment-reply' ); 
?>

<!-- start infinite scroll function  -->
<?php if (!is_single() || !is_page()): ?>

<?php endif; ?>	
<!-- end infinite scroll pagination -->

</head>

<body <?php body_class($class); ?>>

<div id="pagewrap">

	<header id="header" class="pagewidth">
		<div class="headerDivTop">
			<div class="headerLevel1">
				<div class="headerTitleDiv">
					<hgroup>
						<h1 id="site-logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
						<h2 id="site-description"><?php bloginfo('description'); ?></h2>
					</hgroup>
				</div>
			</div>
			
			<div class="headerLevel2">
				<!--Inizio Page-->
				<div class="headerPagesDiv">
					<nav id="main-nav-wrap" class="headerPages">
						<?php wp_nav_menu(array('theme_location' => 'main-nav' , 'fallback_cb' => 'default_main_nav' , 'container'  => '' , 'menu_id' => 'main-nav' , 'menu_class' => 'main-nav')); ?>
					</nav>
				</div>
				<!--Fine Page-->
				
				<!--Inizio Categorie-->
				<div class="headerCategoriesDiv">
					<ul style="	list-style: none;
								float: left;">
						<?php				
							$args=array(
							  'orderby' => 'name',
							  'order' => 'ASC'
							  );								
							 
							$categories=get_categories($args);
							foreach($categories as $category) { 			 
									echo '<li>';
									echo '	<a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "tutti i post nella categoria %s" ), $category->name ) . '" ' . '>' . $category->name.'</a>';
									echo '<li>';
							} 
						?>		
					</ul>				
				</div>
				<!--Fine Categorie-->
			</div>
			
			<!--
			<?php // get searchform.php ?>
			<div id="searchform-wrap">
				<?php get_search_form(); ?>
			</div>

			<div class="social-widget">
				<div class="rss"><a href="<?php echo bloginfo('rss2_url'); ?>">RSS</a></div>
			</div>
			-->
			<!-- /.social-widget -->
		</div>
	</header>
	<!-- /#header -->
	
	<div class="headerFake headerScroll">
	</div>
	
	<div id="body" class="pagewidth clearfix">