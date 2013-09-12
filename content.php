<?php
/*  Theme main content block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <img class="left" src="/wp-content/themes/RPRHAG/media/images/slideshow/3.jpg" height="350" width="350" style="margin-right: 20px" />
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <?php the_content(); ?>
    <footer>
    </footer>
</article>