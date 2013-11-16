<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<!--<article id="post-<?php the_ID(); ?>" <?php post_class("post clearfix $class"); ?>>-->

	<!--<?php the_content(); ?>-->
	
	
<?php $home_query = new WP_Query( "cat=$slider_cat&ignore_sticky_posts=1&showposts=$top_row_posts" );?>
<?php //$the_query = new WP_Query( "ignore_sticky_posts=1" ); ?>

	<table id="table_home">
		<tr>
			<?php while ($home_query->have_posts()) : $home_query->the_post(); ?>	
					
				<?php //Controllo se ha un immagine in evidenza?>
				<?php if (has_post_thumbnail()==1):  $i++; ?>
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
											
					<?php 	//Cattura delle proprieta dell'immagine
							$thumb       = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail_size' );
							$widthThumb  = $thumb[1];
							$heightThumb = $thumb[2];
							
							//Settaggio dei pixel delle immagini della home
							$pixelWidth  = 250;
							$pixelHeight = 300;							
							
							$celleMulti;
							
							//Settaggio della grandezza dell'immagine in caso sia orizzontale o verticale							
							if(($widthThumb/$heightThumb) >= 2){
								$pixelWidth = $pixelWidth *2;
								$celleMulti = "colspan='2'";
							}
							if(($heightThumb/$widthThumb) >= 2){
								$pixelHeight = $pixelHeight *2;
								$celleMulti = "rowspan='2'";
							}
							
							//Ingrandimento delle immagini non abbastanza grandi
							//Se la larghezza non soddisfa il requisito ingrandisco l'immagine
							if($widthThumb < $pixelWidth){
								$per = ($pixelWidth/$widthThumb);
								$widthThumb = $per*$widthThumb;
								$heightThumb = $per*$heightThumb;
							}
							//Se la l'altezza non soddisfa il requisito ingrandisco l'immagine
							if($heightThumb < $pixelHeight){
								$per = ($pixelHeight/$heightThumb);				
								$heightThumb = $per*$heightThumb;
								$widthThumb = $per*$widthThumb;
							}
							
							//Rimpiciolimento delle immagini troppo grandi
							//Se sia l'altezza che la larghezza non soddisfano i requisiti
							//rimpicciolisco il lato piu piccolo fino ad ottenere il risultato desiderato
							if($widthThumb > $pixelWidth && $heightThumb > $pixelHeight){
								if($widthThumb < $heightThumb){
									$diviso = ($widthThumb/$pixelWidth);									
								}else{
									$diviso = ($heightThumb/$pixelHeight);									
								}
								$widthThumb = $widthThumb/$diviso;
								$heightThumb = $heightThumb/$diviso;
							}
							
							//Centramento delle immagini non perfette
							//Se le dimensioni in larghezza non soddisfano i requisiti
							//centro l'immagine orizzontalmente
							if($widthThumb > $pixelWidth){
								$widthMargin = ($widthThumb-$pixelWidth)/2;
							}
							//Se le dimensioni in altezza non soddisfano i requisiti
							//centro l'immagine verticalmente
							if($heightThumb > $pixelHeight){								
								$heightMargin = ($heightThumb-$pixelHeight)/2;
							}						
					?>					
										
					<!--<td id="td_home">-->					
					<td <?php echo $celleMulti?>>	
						<div 	style="display: block; width: <?php echo $pixelWidth;?>px; height: <?php echo $pixelHeight;?>px;  overflow:hidden;" align="center">
							<img src="<?php echo $url; ?>" alt="ciccio<?php echo $i; ?>" 
								class="attachment-post-thumbnail wp-post-image" 
								style="<?php echo "	width: ".$widthThumb."px; 
													height: ".$heightThumb."px; 
													max-width: none; 
													margin-left:-".$widthMargin."px;
													margin-top:-".$heightMargin."px;"
													?>"
							/>							
						</div>
					</td>
					
				<?php endif ?>
				
			<?php endwhile; //wp_reset_postdata(); ?>	
		</tr>
		
	</table>

	
</article>
