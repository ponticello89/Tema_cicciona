
<?php while (have_posts()) : the_post(); ?>
	<?php if (has_post_thumbnail()==1):  $i++; ?>

		<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>
			
		<?php 
			//$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); 
			$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
			$url = $thumb['0']; 
			$width = $thumb['1'];
			$height = $thumb['2'];		
		?>
			
			
		<?php // Ho scritto il javascript in php perche l'url dava problemi una volta spedita
		echo '<script type="text/javascript">';		
		echo 'var url = "' . $url . '";';						
		echo 'var html = "	<div class=\'imageCella\' id=\'imageCella"+totaleImg+"\'>';
		echo '					<img src=\'"+url+"\' class=\'image image1\' id=\'img"+totaleImg+"\' style=\'display: none;\'/>';
		//echo '					<img src=\'"+url+"\' class=\'image image1\' id=\'img"+totaleImg+"\'/>';
		//echo '					<img class=\'image image1\' id=\'img"+totaleImg+"\'/>';
		echo '					<div id=\'img_holder\' class=\'loadit\' style=\'width:100%; height: auto;\'>';
		echo '              	</div>';		
		echo '				</div>";';				
		echo 'loadArray(totaleImg, url);';
		echo 'loadPhotoOnDiv(html);';				
		echo '';
		echo '</script>';
		?>
		
	<?php endif; ?>		
						
<?php endwhile; ?>

<script type="text/javascript">
//reSizeDivImage();
</script>