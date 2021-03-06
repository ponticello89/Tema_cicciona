<?php

///////////////////////////////////////
// You may add your custom functions here
///////////////////////////////////////

	///////////////////////////////////////
	// Load theme languages
	///////////////////////////////////////
	//load_theme_textdomain(TEMPLATEPATH.'/languages' );

	///////////////////////////////////////
	// Enable WordPress feature image
	///////////////////////////////////////
	add_theme_support( 'post-thumbnails');

	///////////////////////////////////////
	// Register Custom Menu Function
	///////////////////////////////////////
	if (function_exists('register_nav_menus')) {
		register_nav_menus( array(
			'main-nav' => __( 'Main Navigation'),
			'footer-nav' => __( 'Footer Navigation'),
		) );
	}

	///////////////////////////////////////
	// Default Main Nav Function
	///////////////////////////////////////
	/*
	function default_main_nav() {
		echo '<ul id="main-nav" class="main-nav clearfix">';
		wp_list_pages('title_li=');
		echo '</ul>';
	}
	*/
	
	///////////////////////////////////////
	// Register Widgets
	///////////////////////////////////////
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name' => 'Sidebar',
			'id' => 'sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title' => '</h4>',
		));
	}

	///////////////////////////////////////
	// Page navigation
	//////////////////////////////////////
	/*
	function ponticello_pagenav($before = '', $after = '') {
		global $wpdb, $wp_query;
	
		$request = $wp_query->request;
		$posts_per_page = intval(get_query_var('posts_per_page'));
		$paged = intval(get_query_var('paged'));
		$numposts = $wp_query->found_posts;
		$max_page = $wp_query->max_num_pages;
	
		if(empty($paged) || $paged == 0) {
			$paged = 1;
		}
		$pages_to_show = apply_filters('themify_filter_pages_to_show', 8);
		$pages_to_show_minus_1 = $pages_to_show-1;
		$half_page_start = floor($pages_to_show_minus_1/2);
		$half_page_end = ceil($pages_to_show_minus_1/2);
		$start_page = $paged - $half_page_start;
		if($start_page <= 0) {
			$start_page = 1;
		}
		$end_page = $paged + $half_page_end;
		if(($end_page - $start_page) != $pages_to_show_minus_1) {
			$end_page = $start_page + $pages_to_show_minus_1;
		}
		if($end_page > $max_page) {
			$start_page = $max_page - $pages_to_show_minus_1;
			$end_page = $max_page;
		}
		if($start_page <= 0) {
			$start_page = 1;
		}
	
		if ($max_page > 1) {
			echo $before.'<div class="pagenav clearfix">';
			if ($start_page >= 2 && $pages_to_show < $max_page) {
				$first_page_text = "&laquo;";
				echo '<a href="'.get_pagenum_link().'" title="'.$first_page_text.'" class="number">'.$first_page_text.'</a>';
			}
			//previous_posts_link('&lt;');
			for($i = $start_page; $i  <= $end_page; $i++) {
				if($i == $paged) {
					echo ' <span class="number current">'.$i.'</span> ';
				} else {
					echo ' <a href="'.get_pagenum_link($i).'" class="number">'.$i.'</a> ';
				}
			}
			//next_posts_link('&gt;');
			if ($end_page < $max_page) {
				$last_page_text = "&raquo;";
				echo '<a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'" class="number">'.$last_page_text.'</a>';
			}
			echo '</div>'.$after;
		}
	}
	*/

	///////////////////////////////////////
	// Add wmode transparent and post-video container for responsive purpose
	///////////////////////////////////////	
	/*
	function ponticello_add_video_wmode_transparent($html, $url, $attr) {
		
		$html = '<div class="post-video">' . $html . '</div>';
		if (strpos($html, "<embed src=" ) !== false) {
			$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
			return $html;
		}
		else {
			if(strpos($html, "wmode=transparent") == false){
				if(strpos($html, "?fs=" ) !== false){
					$search = array('?fs=1', '?fs=0');
					$replace = array('?fs=1&wmode=transparent', '?fs=0&wmode=transparent');
					$html = str_replace($search, $replace, $html);
					return $html;
				}
				else{
					$youtube_embed_code = $html;
					$patterns[] = '/youtube.com\/embed\/([a-zA-Z0-9._-]+)/';
					$replacements[] = 'youtube.com/embed/$1?wmode=transparent';
					return preg_replace($patterns, $replacements, $html);
				}
			}
			else{
				return $html;
			}
		}
	}
	add_filter('embed_oembed_html', 'ponticello_add_video_wmode_transparent');
	*/
	
	///////////////////////////////////////
	// Custom Theme Comment List Markup
	///////////////////////////////////////
	function custom_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   ?>

	<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
		<p class="comment-author"> 
			<?php echo get_avatar($comment,$size='48'); ?> <?php printf('<cite>%s</cite>', get_comment_author_link()) ?><br />
			<small class="comment-time"><strong>
			<?php comment_date('M d, Y'); ?>
			</strong> @
			<?php comment_time('H:i:s'); ?>
			<?php edit_comment_link( __('Edit'),' [',']') ?>
			</small>
		</p>
		<div class="commententry">
			<?php if ($comment->comment_approved == '0') : ?>
			<p>
				<em><?php _e('Your comment is awaiting moderation.') ?></em>
			</p>
			<?php endif; ?>
			<?php comment_text() ?>
		</div>
		<p class="reply">
			<?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => $depth, 'reply_text' => __( 'Reply' ), 'max_depth' => $args['max_depth']))) ?>
		</p>
	<?php
	}
		
	///////////////////////////////////////
	// Restituisce l'url attuale
	///////////////////////////////////////		
	function curPageURL() {
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
			
	///////////////////////////////////////
	// Infinitive scroll pagination
	///////////////////////////////////////	
	add_action('wp_ajax_infinite_scroll', 		 'wp_infinitepaginate');    // for logged in user
	add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');    // if user not logged in

	function wp_infinitepaginate(){
		$loopFile        = $_POST['loop_file'];
		$paged           = $_POST['page_no'];
		//$category_name	 = $_POST['category_name'];
		$category_id	 = $_POST['category_id'];
		$where			 = $_POST['where'];
		$posts_per_page  = get_option('posts_per_page');
				
		//query_posts( array( 'category__and' => array(1,3), 'posts_per_page' => 2, 'orderby' => 'title', 'order' => 'DESC' ) );
		//category_name=senza-categoria		
		$arrayQueryPost = array();						
		$arrayQueryPost['paged'] = $paged;		
		$arrayQueryPost['post_status'] = 'publish';		

		//if($category_name != null && $category_name != ""){
		//	$arrayQueryPost['category_name'] = $category_name;				
		//}		
		if($category_id != null && $category_id != "" && $category_id != 1){
			$arrayQueryPost['cat'] = $category_id;				
		}		
		query_posts($arrayQueryPost);			
				
		if(have_posts() == null){
	?>
			<script type="text/javascript">					
				finishImage = "true";				
			</script>
	<?php					
		}else{		
			get_template_part( $loopFile );				
		}	 				
	?>
		<script type="text/javascript">		
			$('a.inifiniteLoaderDown').fadeOut('1000');	
			$('a.inifiniteLoaderUp').fadeOut('1000');		
		</script>			
	<?php		
				
		//wp_reset_query();
		
		exit;
	}

	function my_scripts_method() {
		wp_deregister_script( 'jquery' );
		//wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
		wp_enqueue_script( 'jquery' );
	}    	 
	add_action('wp_enqueue_scripts', 'my_scripts_method');

	///////////////////////////////////////
	// Inclusione opzioni tema
	///////////////////////////////////////
	require_once (TEMPLATEPATH . '/includes/opzioni_tema.php');	
	
	///////////////////////////////////////
	// Next e Previus Article
	///////////////////////////////////////
	function get_next_post_url() {
		$nextPost=get_next_post(); 
		$nextPostId=$nextPost->ID;
		if($post->ID!=$nextPostId){
			$nextPostUrl = get_permalink($nextPostId); 
			return $nextPostUrl;
		}
		return null;
	}    
	function get_prev_post_url() {
		$prevPost=get_previous_post(); 
		$prevPostId=$prevPost->ID;
		if($post->ID!=$prevPostId){
			$prevPostUrl = get_permalink($prevPostId); 
			return $prevPostUrl;
		}
		return null;
	}	
	
	///////////////////////////////////////
	// Get page of article
	///////////////////////////////////////
	function getPageOfArticle($idArticle, $idCategory){
							
		$trovato = false;
		$cont = 0;
		$returnPage = 1;
		while(! $trovato):
			$cont++;
		
			$arrayQueryPost = array();						
			$arrayQueryPost['paged'] = $cont;		
			$arrayQueryPost['post_status'] = 'publish';					
			
			if($idCategory != null && $idCategory != "" && $idCategory != 1){
				$arrayQueryPost['cat'] = $idCategory;				
			}					
			query_posts($arrayQueryPost);			
			
			$contArticle = 0;
			while (have_posts()){
				the_post();
				if (has_post_thumbnail()){
					$contArticle++;									
									
					if(get_the_ID() == $idArticle){
						$returnPage = $cont;
						$trovato = true;					
					}												
				}												
			}
			
			//si ferma quando la query restituisce 0 articoli
			if($contArticle == 0){
				$trovato = true;
			}
			
			wp_reset_query();
		endwhile;
		
		return $returnPage;
	}
	
	///////////////////////////////////////
	// Get page of article
	///////////////////////////////////////
	function getNextArticleOfCategory($idArticle, $idCategory){
							
		$trovatoCurrent = false;
		$trovatoNext = false;		
		$returnNext = null;
		$cont = 0;
		while(! $trovatoNext):
			$cont++;
		
			$arrayQueryPost = array();						
			$arrayQueryPost['paged'] = $cont;		
			$arrayQueryPost['post_status'] = 'publish';					
			if($idCategory != null && $idCategory != "" && $idCategory != 1){
				$arrayQueryPost['cat'] = $idCategory;				
			}		
			query_posts($arrayQueryPost);			
			
			$contArticle = 0;
			while (have_posts()){
				the_post();
				if (has_post_thumbnail()){
					$contArticle++;									
					
					if($trovatoCurrent){
						$returnNext = get_the_ID();					
						$trovatoNext = true;
						break;
					}
					if(get_the_ID() == $idArticle){						
						$trovatoCurrent = true;					
					}												
				}
			}
			
			//si ferma quando la query restituisce 0 articoli
			if($contArticle == 0){
				$trovatoNext = true;
			}
			
			wp_reset_query();
		endwhile;
		
		return $returnNext;
	}
	
	function getPrevArticleOfCategory($idArticle, $idCategory){
							
		$trovatoCurrent = false;
		$trovatoPrev = false;		
		$returnPrev = null;
		$cont = 0;
		while(! $trovatoPrev):
			$cont++;
		
			$arrayQueryPost = array();						
			$arrayQueryPost['paged'] = $cont;			
			$arrayQueryPost['post_status'] = 'publish';		
			if($idCategory != null && $idCategory != "" && $idCategory != 1){
				$arrayQueryPost['cat'] = $idCategory;				
			}		
			query_posts($arrayQueryPost);			
			
			$contArticle = 0;
			while (have_posts()){
				the_post();
				if (has_post_thumbnail()){
					$contArticle++;									
									
					if(get_the_ID() != $idArticle){					
						$returnPrev = get_the_ID();					
					}else{
						$trovatoPrev = true;
						break;
					}
				}
			}
			
			//si ferma quando la query restituisce 0 articoli
			if($contArticle == 0){
				$trovatoPrev = true;
			}
			
			wp_reset_query();
		endwhile;
		
		return $returnPrev;
	}
		
	///////////////////////////////////////
	// META-BOX PAGINATION IMAGE
	///////////////////////////////////////
	require_once (TEMPLATEPATH . '/includes/meta-box.php');	
	
	///////////////////////////////////////
	// tutorial img
	///////////////////////////////////////
	require_once ( TEMPLATEPATH .  '/includes/wptuts-options.php'  );  
?>