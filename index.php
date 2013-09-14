<?php
/*  Theme index.php
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php
	if(is_home() || is_front_page()){
		get_template_part( 'content', 'homepage' );
	}else{
		get_template_part( 'content', get_post_format() );
	}
?>
<?php endwhile; else: ?>
<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif; ?>
<?php get_footer(); ?>

