<?php
/*  Theme main header block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<!DOCTYPE html>
<html  xmlns:fb="http://ogp.me/ns/fb#" xmlns:og="http://ogp.me/ns#" dir="ltr" lang="en-GB">
<head>
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/scripts/html5shiv.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/scripts/html5shiv-printshiv.js"></script>
    <![endif]-->
    
    <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>
    <link rel="shortcut icon" href="/favicon.ico">
    <?php include_once("includes/analyticstracking.php"); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <?php wp_meta(); ?>
    <?php wp_head(); ?>
</head>
<?php
$backgroundColour = false;
$RPRHAG_category = 0;
if(is_category()){
    $RPRHAG_category = get_the_category();
    $RPRHAG_category = $RPRHAG_category[0]->cat_ID;
    $backgroundColour = get_term_meta($RPRHAG_category[0]->cat_ID, 'RPRHAG_background_colour', true);
}else{
    $backgroundColour = get_post_meta(get_the_ID(), 'RPRHAG_background_colour', true);
}
$backgroundColour = ((!$backgroundColour)?"green":$backgroundColour);
?>
<body <?php body_class(array('dbootstrap',$backgroundColour)); ?>>
<div class="main">
<div>
<header>
	<nav
		class="metromenu simpoExpandingDiv"
		data-dojo-type="simpo/widget/expandingDiv"
	><a href="<?php echo home_url();?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/media/images/logos/tcc-black.png" width="255" height="117" class="logo" alt="The Christian Centre Logo (Green version)" /></a>
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