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
<header>
	<a href="<?php echo home_url();?>"><img src="<?php echo get_template_directory_uri(); ?>/media/images/logos/tcc-green-inverse.png" width="255" height="117" class="logo" alt="The Christian Centre Logo (Green version)" /></a>
</header>