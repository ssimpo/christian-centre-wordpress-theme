<?php
/*  Theme index.php
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<?php
    get_header();
    $postSeq = 0;
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            get_template_part( 'content', get_post_format() );
            $postSeq++;
        endwhile;
    else:
?><p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php
    endif;
    get_footer();
?>

