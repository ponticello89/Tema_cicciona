
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
		<?php
		echo '<script type="text/javascript">';		
		echo 'var url = "' . $url . '";';		
		echo 'var html = "	<div class=\'imageCella\' id=\'imageCella"+totaleImg+"\'>';
		echo '					<img src=\'"+url+"\' class=\'image image1\' id=\'img"+totaleImg+"\'/>';		
		echo '            		<div id=\'content1\'>';
		echo '                		<h2>Hover Style #2</h2>';
		echo '                		<p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.</p>';
		echo '                		<a href=\'#\' class=\'info\'>Read More</a>';
		echo '            		</div>';
		echo '					<div class=\'mask\' id=\'mask"+totaleImg+"\'></div>';
		echo '					<input type=\'hidden\' id=\'imgW"+totaleImg+"\' value=\'' . $width . '\'/>';
		echo '					<input type=\'hidden\' id=\'imgH"+totaleImg+"\' value=\'' . $height . '\'/>';
		echo '				</div>";';
				
		echo 'loadPhotoOnDiv(html);';
		echo '';
		echo '</script>';
		?>
		
	<?php endif; ?>		
						
<?php endwhile; ?>

<script type="text/javascript">
reSizeDivImage();
</script>