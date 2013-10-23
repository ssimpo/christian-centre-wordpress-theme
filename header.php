<?php
/*  Theme main header block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */

$current_user = wp_get_current_user();
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
    <link rel="apple-touch-icon" href="/touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/touch-icon-ipad-retina.png" />
    <meta property="og:image" content="http://thechristiancentre.org.uk/logo500x500.png" />
    <meta property="og:image:width" content="500" />
    <meta property="og:image:height" content="500" />
    <meta property="og:image" content="http://thechristiancentre.org.uk/logo300x300.png" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    <meta property="og:image" content="http://thechristiancentre.org.uk/touch-icon-iphone.png" />
    <meta property="og:image:width" content="60" />
    <meta property="og:image:height" content="60" />
    <meta property="og:image" content="http://thechristiancentre.org.uk/touch-icon-ipad.png" />
    <meta property="og:image:width" content="72" />
    <meta property="og:image:height" content="72" />
    <meta property="og:image" content="http://thechristiancentre.org.uk/touch-icon-iphone-retina.png" />
    <meta property="og:image:width" content="120" />
    <meta property="og:image:height" content="120" />
    <meta property="og:image" content="http://thechristiancentre.org.uk/touch-icon-ipad-retina.png" />
    <meta property="og:image:width" content="152" />
    <meta property="og:image:height" content="152" />
    <script type="text/javascript">
        var user = {
            "username":"<?php echo (($current_user->ID != 0)?$current_user->user_login:"anonymous"); ?>",
            "firstname":"<?php echo (($current_user->ID != 0)?$current_user->user_firstname:"unknown"); ?>",
            "lastname":"<?php echo (($current_user->ID != 0)?$current_user->user_lastname:"unknown"); ?>",
            "displayname":"<?php echo (($current_user->ID != 0)?$current_user->display_name:"unknown"); ?>",
            "email":"<?php echo $current_user->user_email; ?>",
        };
    </script>
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
	><span itemscope itemtype="http://schema.org/Organization" itemref="tcc-org"><a href="<?php echo home_url();?>" class="logo" itemprop="url"><img src="<?php echo get_template_directory_uri(); ?>/media/images/logos/tcc-black.png" width="255" height="117" class="logo" alt="The Christian Centre Logo" itemprop="logo" /></a><meta itemprop="name" content="The Christian Centre" /></span>
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