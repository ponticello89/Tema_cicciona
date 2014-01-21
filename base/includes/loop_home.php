<?php 
	//Include funzioni di utilità
	require_once (TEMPLATEPATH . '/includes/utility.php'); 			
?>

<?php while (have_posts()) : the_post(); ?>
	
	<?php if (has_post_thumbnail()==1):  $i++; ?>
						
		<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
				
		<?php 
			//$catId = htmlspecialchars($_GET["cat"]);
		
			//$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
			$urlArticle = get_permalink($post->ID);
		
			if($category_id != null && $category_id != "" ){
				$urlArticle = $urlArticle . '&cat='. $category_id;
			}
			
			$titleArticle = get_the_title($post->ID);			
			$thumb 		  = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			//$thumb      = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );			
			//$thumb      = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'medium'), 'thumbnail_size' );
			$urlImage 	  = $thumb['0']; 
			$width 		  = $thumb['1'];
			$height 	  = $thumb['2'];													
		?>
			
			
		<?php if($width != null || $width!=0) :?>
		
			<?php // Ho scritto il javascript in php perche l'url dava problemi una volta spedita
			echo '<script type="text/javascript">';		
			echo 'var urlImage 		= "' . $urlImage . '";';				
			echo 'var urlArticle 	= "' . $urlArticle . '";';			
			echo 'if(categoryId != null && categoryId != \'\'){';
			echo '	urlArticle = urlArticle+\'&cat=\'+categoryId;';
			echo '}else{';
			echo '	urlArticle = urlArticle;';
			echo '}';
			echo 'var widthImage 	= "' . $width . '";';				
			echo 'var heightImage 	= "' . $height . '";';
			echo 'var titleArticle 	= "' . $titleArticle . '";';			
			echo 'var idArticle 	= "' . $post->ID . '";';			
			
			
			//echo 'var html = "	<div class=\'imageCella\' id=\'imageCella"+totaleImg+"\'>';			
			echo 'var html = "	<div class=\'imageCella loadit\' id=\'imageCella"+idArticle+"\'>';			
			
			if(!isPhone()){
				//Apertura Img v1
				//echo '					<a onclick=\'apriImg(\""+urlImage+"\", \""+urlArticle+"\", \""+titleArticle+"\",\""+widthImage+"\", \""+heightImage+"\")\' >';
				echo '					<a onclick=\'apriImg_v2(\""+urlArticle+"\", \""+(currentPage)+"\", \""+categoryId+"\", \""+idArticle+"\")\' >';
				echo '						<img src=\'"+urlImage+"\' class=\'preload image image1\' id=\'img"+totaleImg+"\' style=\'visibility: hidden; opacity: 0;\' alt=\'Ofatalee "+titleArticle+"\'>';						
				echo '						</img>';						
				echo '					</a>';
			}else{
				echo '					<a href=\'"+urlArticle+"\'>';		
				echo '						<img src=\'"+urlImage+"\' class=\'preload image image1\' id=\'img"+totaleImg+"\' style=\'visibility: hidden; opacity: 0;\' alt=\'Ofatalee "+titleArticle+"\'>';						
				echo '						</img>';						
				echo '					</a>';
			}								
			
			//echo '					<div id=\'img_holder\' class=\'loadit\' style=\'width:100px; height: 100px;\'>';
			echo '              	</div>';		
			echo '				</div>";';			
			
			echo 'loadPhotoOnDiv(html, widthImage, heightImage, wherePage, idArticle);';		
			echo '';
			echo '</script>';
			?>
			
		<?php endif; ?>		
		
	<?php endif; ?>		
						
<?php endwhile; ?>