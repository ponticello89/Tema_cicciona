<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo bloginfo('rss2_url'); ?>">

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/media-queries.css">

<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style_grid.css">

<!--
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style_common.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/demo.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/reset.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/style2.css">
-->

<!-- respond.js (add media query support for IE) -->
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.js"></script>
<![endif]-->

<!-- html5.js (HTML5 Shiv for IE) -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- wp_header -->
<?php wp_head(); ?>

<?php // include theme.script.js  ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/theme.script.js"></script>

<?php // enqueue comment-reply.js (require for threaded comments)
	if ( is_singular() && get_option( 'thread_comments' ) )	wp_enqueue_script( 'comment-reply' ); 
?>

</head>

<body <?php body_class($class); ?>>

<div id="pagewrap">

	<header id="header" class="pagewidth">

		<hgroup>
			<h1 id="site-logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<h2 id="site-description"><?php bloginfo('description'); ?></h2>
		</hgroup>

		<?php // main navigation ?>
		<nav id="main-nav-wrap">
			<?php wp_nav_menu(array('theme_location' => 'main-nav' , 'fallback_cb' => 'default_main_nav' , 'container'  => '' , 'menu_id' => 'main-nav' , 'menu_class' => 'main-nav')); ?>
		</nav>

		<?php // get searchform.php ?>
		<div id="searchform-wrap">
			<?php get_search_form(); ?>
		</div>

		<div class="social-widget">
			<div class="rss"><a href="<?php echo bloginfo('rss2_url'); ?>">RSS</a></div>
		</div>
		<!-- /.social-widget -->

	</header>
	<!-- /#header -->

	<div id="body" class="pagewidth clearfix">