<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo bloginfo('rss2_url'); ?>">

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_total.css"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_footer.css">

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/header.js"></script>	
<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>

<?php 
	//Include funzioni di utilità
	require_once (TEMPLATEPATH . '/includes/utility.php'); 		
	if(isPhone() == 1) {
?>	
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_header_mobile.css">
		<script src="<?php echo get_template_directory_uri(); ?>/js/mobile.js"></script>	
		
<?php	
	} else {
?>		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_header.css">						
<?php
	}
?>

<!-- wp_header -->
<?php //wp_head(); ?>
<?php // include theme.script.js  ?>
<!--<script src="<?php echo get_template_directory_uri(); ?>/js/theme.script.js"></script>-->
<!-- start infinite scroll function  -->
<?php //if (!is_single() || !is_page()): ?>
<?php //endif; ?>	
<!-- end infinite scroll pagination -->

<?php // enqueue comment-reply.js (require for threaded comments)
	if ( is_singular() && get_option( 'thread_comments' ) )	wp_enqueue_script( 'comment-reply' ); 	
?>
	<script type="text/javascript">
		var isLoadImage = setInterval(isImageLoad('.headerDivTop', '.preLoad'),300);
		if(isLoadImage){				
			reSizeHeader();
			clearInterval(isLoadImage);
		}
	</script>

</head>

<body <?php body_class($class); ?>>

<script type="text/javascript">
	var isPhone = "<?php echo isPhone(); ?>";	
</script>

<div id="pagewrap">
	
	<header id="header" class="pagewidth">
		<div class="headerDivTop">
			<div class="headerLevel1">
				<div class="headerTitleDiv">
					
						<?php 
							if(get_option('header-type-title') == text){
						?>
							<h1 id="site-logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
						<?php 
							}else if(get_option('header-type-title') == image){
						?>	
							<img src="<?php echo get_template_directory_uri(); ?>/images/header.png" class="logoSite preLoad"
								<?php 
									if(get_option('header-logo-max-width') != ""){
										echo "style=\"max-width : " . get_option('header-logo-max-width') . "px\"";
									}
								?>							
							/>
						<?php 
							}
						?>	
						<h2 id="site-description"><?php bloginfo('description'); ?></h2>
					
				</div>
			</div>
			
			<div class="headerLevel2">								
				<!--Inizio Page-->
				<div class="headerPagesDiv">
					<ul class="headerPagesUl">															
						<?php			
							$pageId = htmlspecialchars($_GET["page_id"]);	
						
							$args=array(
							  'orderby' => 'name',
							  'order' => 'ASC'
							);								
							 
							$pages=get_pages($args);
							foreach($pages as $page) { 										
								if($pageId == $page->ID){
									echo '<li class="current_page_item">';
								}else{
									echo '<li>';
								}										
								echo '	<a href="' . get_page_link( $page->ID ) . '">';
								echo '		'. $page->post_title.'';
								echo '	</a>';
								echo '</li>';								
							} 
						?>		
					</ul>										
				</div>
				<!--Fine Page-->
				
				<!--Inizio Categorie-->				
				<?php	$catId = htmlspecialchars($_GET["cat"]); ?>
								
				<div class="headerCategoriesDiv">
					<ul class="headerCategoriesUl">											
						<li <?php 	if((curPageURL() == (get_option('home').'/')) || (curPageURL() == (get_option('home'))) || $catId==1){
										echo 'class="current_page_item"';
									} ?>
							>
							<a href="<?php echo get_option('home');?>">
								ALL
							</a>
						</li>
						<?php			
													
							$args=array(
							  'orderby' => 'name',
							  'order' 	=> 'ASC'
							);								
							 
							$categories=get_categories($args);
							foreach($categories as $category) { 		
								if($category->term_id != 1){
									if($catId == $category->term_id){
										echo '<li class="current_page_item">';
									}else{
										echo '<li>';
									}										
									echo '	<a href="' . get_category_link( $category->term_id ) . '">';
									echo '		'. $category->name.'';
									echo '	</a>';
									echo '</li>';
								}
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