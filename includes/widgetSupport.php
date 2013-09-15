<?php

register_sidebar( array(
	'name'          => __( 'Main Widget Area', 'RealPeopleRealHopeAmazingGod' ),
	'id'            => 'sidebar-1',
	'description'   => __( 'Appears in the sidebar section of the site.', 'RealPeopleRealHopeAmazingGod' ),
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
) );

?>