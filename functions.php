<?php
/*  Theme functions
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */

$RPRHAG_console_messages = array();

if(!function_exists('console')){
	function RPRHAG_output_console_messages(){
		global $RPRHAG_console_messages;
		
		if (count($RPRHAG_console_messages) > 0) {
			echo '<script type="text/javascript">';
			foreach($RPRHAG_console_messages as $message){
				echo "console.log(JSON.parse('".json_encode($message)."'));";
			}
		echo '</script>';
		}
	}
	
	add_action('wp_footer', 'RPRHAG_output_console_messages', 1);
	
	function console( $message ) {
		global $RPRHAG_console_messages;
		
		array_push($RPRHAG_console_messages, $message);
	}
}

add_theme_support('menus');
register_nav_menu( 'footer', __( 'Footer Menu', 'RPRHAGFooter' ) );
register_nav_menu( 'metro', __( 'Metro Menu', 'RPRHAGMetro' ) );
register_nav_menu( 'site', __( 'Site Menu', 'RPRHAGSite' ) );

// Adds RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );

// Switches default core markup for search form, comment form, and comments
// to output valid HTML5.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

require_once( get_template_directory() . '/includes/addThemeOptions.php' );
require_once( get_template_directory() . '/includes/addMetaFields.php' );
require_once( get_template_directory() . '/includes/widgetSupport.php' );
require_once( get_template_directory() . '/includes/enqueue.php' );
require_once( get_template_directory() . '/includes/metroWalker.php' );
?>