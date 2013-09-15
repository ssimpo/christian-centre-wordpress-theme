<?php
add_action('admin_init','RPRHAG_theme_options_init');

function RPRHAG_theme_options_init() {
	delete_option('RPRHAG_theme_options');
	
    if ( false === RPRHAG_get_theme_options() ) {
		add_option(
			'RPRHAG_theme_options',
			RPRHAG_get_default_theme_options()
		);
		$themeOptions = get_option('RPRHAG_theme_options');
	}
	
	register_setting(
		'RPRHAG_options',
		'RPRHAG_theme_options',
		'RPRHAG_options_validate'
	);
	
	add_settings_field(
		'metro_colours',
		__( 'Metro Panel Colours', 'RPRHAG' ),
		'RPRHAG_settings_field_metro_colours',
		'theme_options',
		'general' 
	);
}

function RPRHAG_get_theme_options() {
	return get_option('RPRHAG_theme_options');
}

function RPRHAG_get_default_theme_options() {
	$default_theme_options = array(
		'metro_colours' => array(
			'green'=>'#b0cb1f',
			'blue'=>'#ef7f1a',
			'orange'=>'#008dd2',
			'pink'=>'#d28d00'
		)
	);
	
	return $default_theme_options;
}

function boldmetro_options_validate($setting) {
	return $setting;
}
?>