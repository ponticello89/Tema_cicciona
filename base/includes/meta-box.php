<?php
$prefix = 'dbt_';

$meta_box = array(
	'id' => 'my-meta-box',
	'title' => 'Custom meta box',
	'page' => 'post',
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'pagination_image',
			'desc' => 'Pagination image html',
			'id'   => 'pagination_image',
			'type' => 'text',
			'std'  => ''
		)
	)
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
	global $meta_box;
	
	add_meta_box($meta_box['id'], $meta_box['title'], 'pagination_image_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);	
}

// Callback function to show fields in meta box
function pagination_image_show_box() {
	global $meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>			
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.gridster.js" type="text/javascript" charset="utf-8"></script>
		<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>

		<script type="text/javascript">
			var gridster;

			$(function(){
				
				$(document).ready(					
					function () {								
						//CARICO L'HIDDEN
						var htmlString = $('.gridster > ul').clone();
						htmlString.find('span').remove();				
						$('#pagination_image').val(htmlString.html());
					}			
				)				
			
				//PROPERTI DEL GRIDSTER
				gridster = $(".gridster > ul").gridster({
					widget_margins: [5, 5],
					widget_base_dimensions: [20, 20],     										
					resize: {
						enabled: true
					}
				}).data('gridster');
				
				//APRE IL BOX PER SELEZIONARE L'IMMAGINE
				$('#upload_logo_button').click(function() {
					tb_show('Aggiungi Immagine', 'media-upload.php?type=image&tab=library&TB_iframe=true');		
					return false;
				});
				
				//AZIONE SCATANATA ALLA SELEZIONE DELL'IMMAGINE
				//LA A CREARE UN WIDGET DI GRIDSTER
				window.send_to_editor = function(html) {
					// html returns a link like this:
					// <a href="{server_uploaded_image_url}"><img src="{server_uploaded_image_url}" alt="" title="" width="" height"" class="alignzone size-full wp-image-125" /></a>
					var image_url = $('img',html).attr('src');
					//alert(html);
					$('#logo_url').val(image_url);
					tb_remove();
					$('#upload_logo_preview img').attr('src',image_url);
					gridster.add_widget(
						'<li style="background-color: white;" data-row="4" data-col="1" data-sizex="10" data-sizey="10">'+				
							//'<img src="'+image_url+'" style="width: 100%;height: 100%;"/>'+
							'<img src="'+image_url+'"/>'+
							'<span id="delete-img" class="delete-img" ></span>'+
						'</li>', 10, 10);	
					
					$('#submit_options_form').trigger('click');
					// $('#uploaded_logo').val('uploaded');
					
				}
							
				//DISABILITATO COMUNQUE ERA UN RESET
				$('#reset_image_pagination').click(function() {
					var r=confirm("Continuando concellerai tutte le immagini!!!!");
					if (r==true){
						
						var cont = 0;
						$('.gridster li').each(function() {	
							alert(cont);
							gridster.remove_widget( $('.gridster li').eq(cont));
							cont++;
						});						
					}																
				});
				
				//CLICK DEL PULSANTE CANCELLA 
				//APERTURA COMANDI
				$('#delete_image_button').click(function() {
					if($('#delete_image_button').val()=="Cancella immagine"){
						var cont = 0;
						$('.gridster li').each(function() {						
							$( this ).append('<span id="delete-img" class="delete-img" >'+cont+'</span>');
							cont++;
						});
						$('#delete_image_button').val("Fine");
						$('#select_delete_image').val("");
						$('#select_delete_image').fadeIn();
						$('#delete_image_ok_button').fadeIn();
					}else if($('#delete_image_button').val()=="Fine"){
						$('#delete_image_button').val("Cancella immagine");
						$('#select_delete_image').fadeOut();
						$('#delete_image_ok_button').fadeOut();						
						$('.delete-img').each(function() {						
							$( this ).remove();							
						});
					}
				});
				
				//CLICK DEL PULSANTE CANCELLA
				//AZIONE DI CANCELLAMENTO
				$('#delete_image_ok_button').click(function() {
					if($('#select_delete_image').val() != ""){
						gridster.remove_widget( $('.gridster li').eq($('#select_delete_image').val()) );
						$('#delete_image_button').val("Cancella immagine");
						$('#select_delete_image').fadeOut();
						$('#delete_image_ok_button').fadeOut();						
						$('.delete-img').each(function() {						
							$( this ).remove();							
						});
					}					
				});
				
				//ESTENZIONE DEL CONTENITORE DEL GRIDSTER
				$('#estendi').click(function() {					
					if($('#estendi').val() == "Estendi"){
						$('.contenitore-gridster').css({ "overflow":"visible"});						
						$('#estendi').val("Comprimi")
					}else if($('#estendi').val() == "Comprimi"){
						$('.contenitore-gridster').css({ "overflow":"scroll"});
						$('#estendi').val("Estendi")
					}
				});
				
				//INTERCETTAZIONE DEL AZIONE DI SALGATAGGIO E PUBLICAZIONE
				$('#publish').click(function() {					
					var htmlString = $('.gridster > ul').clone();
					htmlString.find('span').remove();					
					$('#pagination_image').val(htmlString.html());					
				});
				
				//INTERCETTAZIONE DEL AZIONE DI SALGATAGGIO BOZZA
				$('#save-post').click(function() {					
					var htmlString = $('.gridster > ul').clone();
					htmlString.find('span').remove();					
					$('#pagination_image').val(htmlString.html());					
				});
				
			});			
		</script>
	
		<input type="hidden" name="pagination_image" id="pagination_image"/>
	
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.gridster.css">			
		
		<div style="margin-bottom: 10px;">
			<!--<input id="reset_image_pagination" type="button" class="button" value="Resetta tutto" />-->
			<!-- AGGIUNGI -->
			<input id="upload_logo_button" type="button" class="button" value="Aggiungi immagine" />
			
			<!-- CANCELLA -->
			<input id="delete_image_button" type="button" class="button" value="Cancella immagine" />			
			<input id="select_delete_image" type="text" class="text" style="display: none"/>			
			<input id="delete_image_ok_button" type="button" class="button" value="Cancella!" style="display: none"/>			
			
			<!-- ESTENDI -->
			<input id="estendi" type="button" class="button" value="Estendi" style="float: right;"/>
		</div>
		
		<div class="contenitore-gridster" style="width:100%;overflow: scroll;">		
			<div class="gridster" style="background-color: maroon; width:960px">
			  <ul>
				<?php echo get_post_meta($post->ID, 'pagination_image', true);?>
			  </ul>
			</div>
		</div>			
	<?php
}


//METODO CHE AGGIUNGE FUNZIONALITA ALL'ATTO DEL SELVATAGGIO
add_action('save_post', 'pagination_image_save_data');

// Save data from meta box
function pagination_image_save_data($post_id) {
	global $meta_box;
	
	// verify nonce
	if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
		return $post_id;
	}

	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return $post_id;
	}

	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}
	
	foreach ($meta_box['fields'] as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	}
}

?>