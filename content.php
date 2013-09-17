<?php
/*  Theme main content block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<?php global $postSeq, $RPRHAG_category; ?>
<?php if(is_home() || is_front_page() || ($RPRHAG_category[0]->cat_ID === get_cat_ID('Homepage'))){
    get_template_part( 'content', 'homepage' );
}?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <?php the_content(); ?>
    <footer>
    </footer>
</article>