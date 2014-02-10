<div id="menu-left">	
	<!--Inizio Categorie-->				
	<?php	$catId = htmlspecialchars($_GET["cat"]); ?>		
	<ul>											
		<li 
			<?php 							
				if((is_home() || is_single()) && $catId==""){					
					echo 'class="active"';
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
						echo '<li class="active">';
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
		<?php			
			$pageId = htmlspecialchars($_GET["page_id"]);	
		
			$args=array(
			  'orderby' => 'name',
			  'order' => 'ASC'
			);								
			 
			$pages=get_pages($args);
			foreach($pages as $page) { 										
				if($pageId == $page->ID){
					echo '<li class="active">';
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