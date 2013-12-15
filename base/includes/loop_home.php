<?php 
	//Include funzioni di utilità
	require_once (TEMPLATEPATH . '/includes/utility.php'); 			
?>

<?php while (have_posts()) : the_post(); ?>
	
	<?php if (has_post_thumbnail()==1):  $i++; ?>
						
		<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
				
		<?php 
			//$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
			$urlArticle = get_permalink($post->ID);
			$titleArticle = get_the_title($post->ID);			
			//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			//$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID, 'medium'), 'thumbnail_size' );
			$urlImage = $thumb['0']; 
			$width = $thumb['1'];
			$height = $thumb['2'];										
		?>
			
			
		<?php if($width != null || $width!=0) :?>
		
			<?php // Ho scritto il javascript in php perche l'url dava problemi una volta spedita
			echo '<script type="text/javascript">';		
			echo 'var urlImage = "' . $urlImage . '";';				
			echo 'var urlArticle = "' . $urlArticle . '";';
			echo 'var widthImage = "' . $width . '";';				
			echo 'var heightImage = "' . $height . '";';
			echo 'var titleArticle = "' . $titleArticle . '";';
			
			echo 'var html = "	<div class=\'imageCella\' id=\'imageCella"+totaleImg+"\'>';			
			
			if(isPhone() == "0"){
				echo '					<a onclick=\'apriImg(\""+urlImage+"\", \""+urlArticle+"\", \""+titleArticle+"\",\""+widthImage+"\", \""+heightImage+"\")\' >';
				echo '						<img src=\'"+urlImage+"\' class=\'preload image image1\' id=\'img"+totaleImg+"\' style=\'visibility: hidden; opacity: 0;\'>';						
				echo '						</img>';						
				echo '					</a>';
			}else{
				echo '					<a href=\'"+urlArticle+"\'>';		
				echo '						<img src=\'"+urlImage+"\' class=\'preload image image1\' id=\'img"+totaleImg+"\' style=\'visibility: hidden; opacity: 0;\'>';						
				echo '						</img>';						
				echo '					</a>';
			}								
			
			//echo '					<div id=\'img_holder\' class=\'loadit\' style=\'width:100px; height: 100px;\'>';
			echo '              	</div>';		
			echo '				</div>";';			
			
			echo 'loadPhotoOnDiv(html, widthImage, heightImage);';		
			echo '';
			echo '</script>';
			?>
			
		<?php endif; ?>		
		
	<?php endif; ?>		
						
<?php endwhile; ?>