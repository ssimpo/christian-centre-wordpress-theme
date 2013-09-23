<?php
add_action( 'admin_menu', 'RPRHAG_create_post_colourField' );
add_action( 'save_post', 'RPRHAG_save_post_colourField', 10, 2 );

add_action('category_add_form_fields', 'RPRHAG_add_category_colourField', 10, 1);
add_action('category_edit_form_fields', 'RPRHAG_edit_category_colourField', 10, 1);
add_action('created_category', 'RPRHAG_save_category_colourField', 10, 1);	
add_action('edited_category', 'RPRHAG_save_category_colourField', 10, 1);

function RPRHAG_create_post_colourField() {
	add_meta_box(
		'RPRHAG-colour-field-box',
		'Theme Options',
		'RPRHAG_post_meta_colourField_box',
		'page',
		'side',
		'high'
	);
	add_meta_box(
		'RPRHAG-colour-field-box',
		'Theme Options',
		'RPRHAG_post_meta_colourField_box',
		'post',
		'side',
		'high'
	);
}

function RPRHAG_add_category_colourField($tag) {
	$colour = get_term_meta($tag->term_id, 'RPRHAG_background_colour', true);
	$metroIcon = get_term_meta($tag->term_id, 'RPRHAG_metro_icon', true);
	
	$html = '<div class="form-field">';
	$html .= '<label for="RPRHAG_background_colour">Background Colour:</label>';
	$html .= '<select name="RPRHAG_background_colour" id="RPRHAG_background_colour">';
	$html .= RPRHAG_construct_colourPicker_items($colour);
	$html .= '</select>';
	$html .= '<p class="description">The background colour to apply to this category page.</p>';
	$html .= '</div>';
	
	$html .= '<div class="form-field">';
	$html .= '<label for="RPRHAG_metro_icon">Metro icon:</label>';
	$html .= '<select name="RPRHAG_metro_icon" id="RPRHAG_metro_icon">';
	$html .= RPRHAG_construct_metroPicker_items($metroIcon);
	$html .= '</select>';
	$html .= '<p class="description">The metro icon to apply if the category is linked in the metro menu.</p>';
	$html .= '</div>';
	
	echo $html;
}

function RPRHAG_edit_category_colourField($tag) {
	$colour = get_term_meta($tag->term_id, 'RPRHAG_background_colour', true);
	$metroIcon = get_term_meta($tag->term_id, 'RPRHAG_metro_icon', true);
	
	$html = '<tr class="form-field"><th scope="row" valign="top">';
	$html .= '<label for="RPRHAG_background_colour">Background Colour:</label>';
	$html .= '</th><td>';
	$html .= '<select name="RPRHAG_background_colour" id="RPRHAG_background_colour" class="postform">';
	$html .= RPRHAG_construct_colourPicker_items($colour);
	$html .= '</select>';
	$html .= '<p class="description">The background colour of this category page.</p>';
	$html .= '</td></tr>';
	
	$html .= '<tr class="form-field"><th scope="row" valign="top">';
	$html .= '<label for="RPRHAG_metro_icon">Metro Icon:</label>';
	$html .= '</th><td>';
	$html .= '<select name="RPRHAG_metro_icon" id="RPRHAG_metro_icon" class="postform">';
	$html .= RPRHAG_construct_metroPicker_items($metroIcon);
	$html .= '</select>';
	$html .= '<p class="description">The metro icon to use if this category is linked in the metro menu.</p>';
	$html .= '</td></tr>';
	
	echo $html;
}

function RPRHAG_construct_colourPicker($item) {
	$html = '<select name="RPRHAG_background_colour" id="RPRHAG_background_colour">';
	$html .= RPRHAG_construct_colourPicker_items($item);
	$html .= '</select>';
	return $html;
}

function RPRHAG_construct_metroPicker($item) {
	$html = '<select name="RPRHAG_metro_icon" id="RPRHAG_metro_icon">';
	$html .= RPRHAG_construct_metroPicker_items($item);
	$html .= '</select>';
	return $html;
}

function RPRHAG_construct_colourPicker_items($item=false) {
    $themeOptions = get_option('RPRHAG_theme_options');
	
	$html = '';
	foreach($themeOptions['metro_colours'] as $name => $colour) {
		if ($item) {
			if ($name == $item) {
				$html .= "<option value=\"$name\" selected='selected'>".ucfirst($name)."</option>";
			} else {
				$html .= "<option value=\"$name\">".ucfirst($name)."</option>";
			}
		} else {
			$html .= "<option value=\"$name\">".ucfirst($name)."</option>";
		}
	}
	
	return $html;
}

function RPRHAG_construct_metroPicker_items($item=false) {
    $themeOptions = get_option('RPRHAG_theme_options');
	
	$html = '';
	foreach($themeOptions['metro_icons'] as $name => $icon) {
		if ($item) {
			if ($name == $item) {
				$html .= "<option value=\"$name\" selected='selected'>".ucfirst($name)."</option>";
			} else {
				$html .= "<option value=\"$name\">".ucfirst($name)."</option>";
			}
		} else {
			$html .= "<option value=\"$name\">".ucfirst($name)."</option>";
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
	</p><p>
		<label for="RPRHAG_metro_icon">Metro Icon:</label>
		<br />
		<?php
			$metroIcon = get_post_meta( $object->ID, 'RPRHAG_metro_icon', true );
			echo RPRHAG_construct_metroPicker($metroIcon);
		?>
	</p><p>
		<?php
			$order = get_post_meta( $object->ID, 'RPRHAG_post_order', true );
			if($order == ""){
				$order = 0;
			}
		?>
		<label for="RPRHAG_post_order">Post Order:</label>
		<br />
		<input type="number" cass="postform" name="RPRHAG_post_order" id="RPRHAG_post_order" value="<?php echo $order; ?>" style="width:65px" />
	</p>
<?php }

function RPRHAG_save_term_meta_field( $post_id, $fieldName) {
	$meta_value = get_term_meta( $post_id, $fieldName, true );
	$new_meta_value = stripslashes( $_POST[$fieldName] );

	if ( $new_meta_value && '' == $meta_value ) {
		add_term_meta( $post_id, $fieldName, $new_meta_value, true );
	} elseif ( $new_meta_value != $meta_value ) {
		update_term_meta( $post_id, $fieldName, $new_meta_value );
	} elseif ( '' == $new_meta_value && $meta_value ) {
		delete_term_meta( $post_id, $fieldName, $meta_value );
	}
}

function RPRHAG_save_post_meta_field( $post_id, $fieldName) {
	$meta_value = get_post_meta( $post_id, $fieldName, true );
	$new_meta_value = stripslashes( $_POST[$fieldName] );

	if ( $new_meta_value && '' == $meta_value ) {
		add_post_meta( $post_id, $fieldName, $new_meta_value, true );
	} elseif ( $new_meta_value != $meta_value ) {
		update_post_meta( $post_id, $fieldName, $new_meta_value );
	} elseif ( '' == $new_meta_value && $meta_value ) {
		delete_post_meta( $post_id, $fieldName, $meta_value );
	}
}

function RPRHAG_save_category_colourField( $post_id) {
	RPRHAG_save_term_meta_field( $post_id, 'RPRHAG_background_colour');
	RPRHAG_save_term_meta_field( $post_id, 'RPRHAG_metro_icon');
}

function RPRHAG_save_post_colourField( $post_id, $post ) {
	RPRHAG_save_post_meta_field( $post_id, 'RPRHAG_background_colour');
	RPRHAG_save_post_meta_field( $post_id, 'RPRHAG_metro_icon');
	RPRHAG_save_post_meta_field( $post_id, 'RPRHAG_post_order');
}
?>