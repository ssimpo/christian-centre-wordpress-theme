<?php
/*  Theme main content block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if(is_home() || is_front_page()){
    get_template_part( 'content', 'homepage' );
}?>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <?php the_content(); ?>
    <footer>
    </footer>
</article>