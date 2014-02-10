<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
	if(get_option('meta-description') != ""){	
?>
		<meta name="description" content="<?php echo get_option('meta-description'); ?>">
<?php
	}
	if(get_option('meta-keywords') != ""){
?>
		<meta name="keywords" content="<?php echo get_option('meta-keywords'); ?>">
<?php	
	}	
?>

<?php //Titolo e icona del TAB ?>
<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico" />

<?php //RSS2 ?>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo bloginfo('rss2_url'); ?>">

<?php //CSS ?>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_total.css"/>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_footer.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_header.css">
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/jquery.sidr.dark.css">
<?php //JS ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/header.js"></script>	
<script src="<?php echo get_template_directory_uri(); ?>/js/preload.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.sidr.min.js"></script>

<?php 
	//Includo funzioni di utilità
	require_once (TEMPLATEPATH . '/includes/utility.php'); 		
?>	

<?php 
	//Carico jar diversi a seconda della macchina dell'utente PC/PHONE
	if(isPhone() == 1) {
?>	
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_social_mobile.css">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_header_mobile.css">
		<script src="<?php echo get_template_directory_uri(); ?>/js/mobile.js"></script>			
<?php	
	} else {
?>		
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_header_pc.css">						
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_social.css">		
<?php
	}
?>

<?php 
	if ( is_singular() && get_option( 'thread_comments' ) )	wp_enqueue_script( 'comment-reply' ); 	
?>

	<script type="text/javascript">
		//Controlla se l'immagine è carica 
		//quando sarà carica eseguira l'azione e smettera di controllare
		var stopIsImageLoad = setInterval(function(){
			
				var isLoadImage = isImageLoad('.headerDivTop', '.preLoad');			
				if(isLoadImage){				
					clearInterval(stopIsImageLoad);					
					reSizeHeader();
				}
			}
			, 300);		
	</script>

	<?php
		if (is_single()){
			$curUrl 	  = curPageURL();			
			$idArticle    = htmlspecialchars($_GET["p"]);
			$titleArticle = get_the_title($idArticle); 
			$thumb 		  = wp_get_attachment_image_src( get_post_thumbnail_id($idArticle), 'small');			
			$urlImage 	  = $thumb['0']; 
			echo "<meta property=\"og:url\"   content=\"" . $curUrl       . "\" >";
			echo "<meta property=\"og:title\" content=\"" . $titleArticle . "\" >";
			echo "<meta property=\"og:image\" content=\"" . $urlImage     . "\" >";
		}else if(is_home() || is_category() || is_page()){			
			echo "<meta property=\"og:image\" content=\"" . get_template_directory_uri() . "/images/header.png\" >";
		}
	?></head>

<body <?php body_class($class); ?>>

<script type="text/javascript">
	//Forse si puo cancellare
	var isPhone = "<?php echo isPhone(); ?>";	
</script>

<div id="pagewrap">
	
	<div class="overTheTop">
		<span class="overTheTopSpan">Loading...</span>
	</div>
	
	<!-- /#header -->	
	<header id="header" class="pagewidth">
		<div class="headerDivTop">
			<div class="headerLevel1">
				<div class="headerTitleDiv">
									
					<?php 
						//LOGO O TITOLO DEL SITO
						if(get_option('header-type-title') == text){
					?>
							<h1 id="site-logo">
								<a href="<?php echo get_option('home'); ?>">
									<?php bloginfo('name'); ?>
								</a>
							</h1>
					<?php 
						}else if(get_option('header-type-title') == image){
					?>	
							<a href="<?php echo get_option('home'); ?>">
								<img src="<?php echo get_template_directory_uri(); ?>/images/header.png" class="logoSite preLoad"
									<?php 
										if(get_option('header-logo-max-width') != ""){
											echo "style=\"max-width : " . get_option('header-logo-max-width') . "px\"";
										}
									?>							
								/>
							</a>
					<?php 
						}
					?>	
					<h2 id="site-description"><?php bloginfo('description'); ?></h2>
					
				</div>
			</div>
			
			<?php 
			if(is_home() || is_category() ){
			?>
				<div class="headerSocialDiv" style="width: 100%;">
					<div style="float: right;">
						<!-- SOCIAL-->			
											
						<?php 
						if(!isPhone()){
							require_once (TEMPLATEPATH . '/includes/social.php');
						}else{
							require_once (TEMPLATEPATH . '/includes/social_mobile.php');
						}
						?>					
						
						<!-- SOCIAL-->	
					</div>				
				</div>	
			<?php 	
			}
			?>			
			<div class="headerLevel2">				
				<!--Inizio Categorie-->				
				<?php	$catId = htmlspecialchars($_GET["cat"]); ?>			
				<ul class="headerCategoriesUl">											
					<li 
						<?php 										
						if((is_home() || is_single()) && $catId==""){										
							echo 'class="current_page_item"';
						} 
						?>
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
				
				<ul class="headerCategoriesUlBotton">					
					<li class="socialLi">						
						<p class="listBtn left-menu"></p>																	
					</li>	
					<li>						
						<a class="left-menu">Menu</a>																	
					</li>					
				</ul>				
				<script>
					$(document).ready(function() {
						$('#menu-left').css({'visibility' : 'visible'});
						$('.left-menu').sidr({
							name: 'menu-left',
							side: 'left'
						});												
					});
				</script>						
				<!--Fine Categorie-->
				
				<!--Inizio Page-->		
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
				<!--Fine Page-->			
			</div>						
		</div>						
	</header>
		
	<!-- /#header -->
		
	<div class="headerFake headerScroll">
	</div>
	
	
	<div id="body" class="pagewidth clearfix">