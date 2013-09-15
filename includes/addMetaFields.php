<?php
add_action( 'admin_menu', 'RPRHAG_create_post_colourField' );
add_action( 'save_post', 'RPRHAG_save_post_colourField', 10, 2 );

function RPRHAG_create_post_colourField() {
	add_meta_box(
		'RPRHAG-colour-field-box',
		'Background Colour',
		'RPRHAG_post_meta_colourField_box',
		'page',
		'side',
		'high'
	);
}

function RPRHAG_construct_colourPicker($item) {
	$html = '<select name="RPRHAG_background_colour">';
	$html .= RPRHAG_construct_colourPicker_items($item);
	$html .= '</select>';
	return $html;
}

function RPRHAG_construct_colourPicker_items($item=false) {
    $themeOptions = get_option('RPRHAG_theme_options');
	
	$html = '';
	foreach($themeOptions['metro_colours'] as $name => $colour) {
		if ($item) {
			if ($name == $item) {
				$html .= "<option value='$name' selected='selected'>$name</option>";
			} else {
				$html .= "<option value='$name'>$name</option>";
			}
		} else {
			$html .= "<option value='$name'>$name</option>";
		}
	}
	
	return $html;
}

function RPRHAG_post_meta_colourField_box($object,$box) {?>
 
	<p>
		<label for="RPRHAG_background_colour">Page Colour:</label>
		<br />
		<?php
			$colour = get_post_meta( $object->ID, 'RPRHAG_background_colour', true );
			echo RPRHAG_construct_colourPicker($colour);
		?>
	</p>
<?php }

function RPRHAG_save_post_colourField( $post_id, $post ) {
	$meta_value = get_post_meta( $post_id, 'RPRHAG_background_colour', true );
	$new_meta_value = stripslashes( $_POST['RPRHAG_background_colour'] );

	if ( $new_meta_value && '' == $meta_value ) {
		add_post_meta( $post_id, 'RPRHAG_background_colour', $new_meta_value, true );
	} elseif ( $new_meta_value != $meta_value ) {
		update_post_meta( $post_id, 'RPRHAG_background_colour', $new_meta_value );
	} elseif ( '' == $new_meta_value && $meta_value ) {
		delete_post_meta( $post_id, 'RPRHAG_background_colour', $meta_value );
	}
}
?>