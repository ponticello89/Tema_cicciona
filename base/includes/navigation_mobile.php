<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/style_navigation_mobile.css">

<div class="navPhone">
	<!--Inizio Categorie-->				
	<?php	$catId = htmlspecialchars($_GET["cat"]); ?>	
	<div>		
		<ul class="ulMobileNav">											
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
	</div>
	<!--Fine Categorie-->
		
	<!--Inizio Page-->
	<div >
		<ul class="ulMobileNav">															
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
</div>