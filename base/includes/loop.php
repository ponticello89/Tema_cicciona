<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<!--<article id="post-<?php the_ID(); ?>" <?php post_class("post clearfix $class"); ?>>-->

	<!--<?php the_content(); ?>-->
	
	
<?php $home_query = new WP_Query( "cat=$slider_cat&ignore_sticky_posts=1&showposts=$top_row_posts" );?>
<?php //$the_query = new WP_Query( "ignore_sticky_posts=1" ); ?>

	<table id="table_home">
		<tr>
			<?php while ($home_query->have_posts()) : $home_query->the_post(); ?>	
					
				<?php if (has_post_thumbnail()==1):  $i++; ?>
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					
					<td id="td_home">
						<img width="300" height="300" src="<?php echo $url; ?>" alt="ciccio<?php echo $i; ?>" class="attachment-post-thumbnail wp-post-image"/>
						<?php $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );?>
						<!--<?php
						$conta = count($thumb);
						for($i=0;$i<$conta;$i++){
							echo"<span>".$thumb[$i]."</span><br>";
						}
						?>-->
						<?php echo get_the_post_thumbnail(); ?>	
						
						
					</td>
				<?php endif ?>
				
			<?php endwhile; //wp_reset_postdata(); ?>	
		</tr>
	</table>

	
</article>
