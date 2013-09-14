<?php
/*  Theme functions
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
add_theme_support('menus');

// Adds RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );

// Switches default core markup for search form, comment form, and comments
// to output valid HTML5.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

register_sidebar( array(
	'name'          => __( 'Main Widget Area', 'RealPeopleRealHopeAmazingGod' ),
	'id'            => 'sidebar-1',
	'description'   => __( 'Appears in the sidebar section of the site.', 'RealPeopleRealHopeAmazingGod' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
) );

require_once( get_template_directory() . '/includes/enqueue.php' );
?>