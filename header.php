<?php
/*  Theme main header block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<html>
<head>
    <title><?php wp_title(); ?></title>
    <?php wp_meta(); ?>
    <?php wp_head(); ?>
</head>
<body <?php body_class(array('claro','green')); ?>>
<div class="main">
<div>
<header>
	<nav class="metromenu" data-dojo-type="simpo/widget/expandingDiv">
		<a href="<?php echo home_url();?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/media/images/logos/tcc-black.png" width="255" height="117" class="logo" alt="The Christian Centre Logo (Green version)" /></a>
		<?php
			$metroMenu =  wp_nav_menu(array(
				'theme_location' => 'metro',
				'depth' => 1,
				'items_wrap' => '%3$s',
				'container' => false,
				'echo' => false,
				'walker' => new RPRHAG_metroWalker(),
				'link_before' => '<div>',
				'link_after' => '</div>'
			));
			echo strip_tags($metroMenu, '<a><div>' );
		?>
	</nav>
</header>