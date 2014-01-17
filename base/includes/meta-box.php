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
		),
		array(
			'name' => 'Text box',
			'desc' => 'Enter something here',
			'id' => $prefix . 'text',
			'type' => 'text',
			'std' => 'Default value 1'
		),
		array(
			'name' => 'Textarea',
			'desc' => 'Enter big text here',
			'id' => $prefix . 'textarea',
			'type' => 'textarea',
			'std' => 'Default value 2'
		),
		array(
			'name' => 'Select box',
			'id' => $prefix . 'select',
			'type' => 'select',
			'options' => array('Option 1', 'Option 2', 'Option 3')
		),
		array(
			'name' => 'Radio',
			'id' => $prefix . 'radio',
			'type' => 'radio',
			'options' => array(
				array('name' => 'Name 1', 'value' => 'Value 1'),
				array('name' => 'Name 2', 'value' => 'Value 2')
			)
		),
		array(
			'name' => 'Checkbox',
			'id' => $prefix . 'checkbox',
			'type' => 'checkbox'
		)
	)
);

add_action('admin_menu', 'mytheme_add_box');

// Add meta box
function mytheme_add_box() {
	global $meta_box;
	
	add_meta_box($meta_box['id'], $meta_box['title'], 'mytheme_show_box_2', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
	//add_meta_box($meta_box['id'].'study', $meta_box['title'], 'mytheme_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function mytheme_show_box_2() {
	global $meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>			
		
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.10.2.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.gridster.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript">
			var gridster;

			$(function(){

				gridster = $(".gridster > ul").gridster({
					widget_margins: [3, 3],
					widget_base_dimensions: [24, 24],        
					min_cols: 3,
					min_row: 3,
					max_cols: 40,
					resize: {
						enabled: true
					}
				}).data('gridster');
				
				$('#upload_logo_button').click(function() {
					tb_show('Aggiungi Immagine', 'media-upload.php?type=image&tab=library&TB_iframe=true');		
					return false;
				});
				
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
							'<img src="'+image_url+'" style="width: 100%;height: 100%;"/>'+
						'</li>', 10, 10);	
					
					$('#submit_options_form').trigger('click');
					// $('#uploaded_logo').val('uploaded');
					
				}
								
				$('#estendi').click(function() {					
					if($('#estendi').val() == "Estendi"){
						$('.contenitore-gridster').css({ "overflow":"visible"});						
						$('#estendi').val("Comprimi")
					}else if($('#estendi').val() == "Comprimi"){
						$('.contenitore-gridster').css({ "overflow":"scroll"});
						$('#estendi').val("Estendi")
					}
				});
								
				$('#save_pagination_image').click(function() {
					
					var htmlString = $('.gridster > ul').clone();
					htmlString.find('span').remove();					
					$('#pagination_image').val(htmlString.html());						
				});
			});			
		</script>
	
		<input type="hidden" name="pagination_image" id="pagination_image" value="" />
	
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/jquery.gridster.css">
			<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style_ll.css">-->
		
		<input id="upload_logo_button" type="button" class="button" value="Aggiungi immagine" />
		<input id="estendi" type="button" class="button" value="Estendi" />
		
		<div class="contenitore-gridster" style="width:100%;overflow: scroll;">		
			<div class="gridster" style="background-color: maroon; width:1000px">
			  <ul>
				<?php echo get_post_meta($post->ID, 'pagination_image', true);?>
			  </ul>
			</div>
		</div>
		
		<input id="save_pagination_image" type="button" class="button" value="Salva" />				
	<?php
}

// Callback function to show fields in meta box
function mytheme_show_box() {
	global $meta_box, $post;
	
	// Use nonce for verification
	echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	
	echo '<table class="form-table">';
			
	foreach ($meta_box['fields'] as $field) {
		// get current post meta data
		$meta = get_post_meta($post->ID, $field['id'], true);
		
		echo '<tr>',
				'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
				'<td>';
		switch ($field['type']) {
			case 'text':
				echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
					'<br />', $field['desc'];
				break;
			case 'textarea':
				echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
					'<br />', $field['desc'];
				break;
			case 'select':
				echo '<select name="', $field['id'], '" id="', $field['id'], '">';
				foreach ($field['options'] as $option) {
					echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				echo '</select>';
				break;
			case 'radio':
				foreach ($field['options'] as $option) {
					echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
				}
				break;
			case 'checkbox':
				echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
				break;
		}
		echo 	'<td>',
			'</tr>';
	}
	
	echo '</table>';
}

add_action('save_post', 'save_pagination_image');

// Save data from meta box
function save_pagination_image($post_id) {
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
	
	$old = get_post_meta($post->ID, 'pagination_image', true);	
	$new = $_POST['pagination_image'];
	?>
		<script type="text/javascript">
			alert('<?php echo $new?>');
		</script>
	<?php
	if ($new && $new != $old) {
		update_post_meta($post_id, 'pagination_image', $new);
	} elseif ('' == $new && $old) {
		delete_post_meta($post_id, 'pagination_image', $old);
	}	
}

add_action('save_post', 'mytheme_save_data');

// Save data from meta box
function mytheme_save_data($post_id) {
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