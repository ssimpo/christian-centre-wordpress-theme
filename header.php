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
	<nav class="metromenu">
		<a href="<?php echo home_url();?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/media/images/logos/tcc-black.png" width="255" height="117" class="logo" alt="The Christian Centre Logo (Green version)" /></a>
		<a href="/contactus" class="contact green metro"><div>&nbsp;</div>Contact Us</a>
		<a href="/events" class="events blue metro"><div>&nbsp;</div>Events</a>
		<a href="/contactus" class="children orange metro"><div>&nbsp;</div>Children</a>
		<a href="/contactus" class="students green metro"><div>&nbsp;</div>Students</a>
		<a href="/contactus" class="podcast orange metro"><div>&nbsp;</div>Podcast</a>
		<a href="/contactus" class="prayer orange metro"><div>&nbsp;</div>Prayer</a>
		<a href="/contactus" class="team blue metro"><div>&nbsp;</div>The Team</a>
		<a href="/contactus" class="vision green metro"><div>&nbsp;</div>Vision</a>
		<a href="/contactus" class="statement orange metro"><div>&nbsp;</div>Statement of Faith</a>
		<a href="/contactus" class="history blue metro"><div>&nbsp;</div>History</a>
	</nav>
</header>