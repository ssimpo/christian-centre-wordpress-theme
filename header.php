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
		<a href="/contactus" class="contact green metro"><div>Contact Us</div></a>
		<a href="/events" class="events blue metro"><div>Events</div></a>
		<a href="/children" class="children orange metro"><div>Children</div></a>
		<a href="/students" class="students green metro"><div>Students</div></a>
		<a href="/podcast" class="podcast orange metro"><div>Podcast</div></a>
		<a href="/prayer" class="prayer orange metro"><div>Prayer</div></a>
		<a href="/the_team" class="team blue metro"><div>The Team</div></a>
		<a href="/vision" class="vision green metro"><div>Vision</div></a>
		<a href="/statement_of_faith" class="statement orange metro"><div>Statement of Faith</div></a>
		<a href="/history" class="history blue metro"><div>History</div></a>
		<a href="/students" class="students green metro"><div>Students</div></a>
		<a href="/podcast" class="podcast orange metro"><div>Podcast</div></a>
		<a href="/prayer" class="prayer orange metro"><div>Prayer</div></a>
		<a href="/the_team" class="team blue metro"><div>The Team</div></a>
		<a href="/vision" class="vision green metro"><div>Vision</div></a>
		<a href="/statement_of_faith" class="statement orange metro"><div>Statement of Faith</div></a>
		<a href="/history" class="history blue metro"><div>History</a>
	</nav>
</header>