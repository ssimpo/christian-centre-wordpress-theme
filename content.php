<?php
/*  Theme main content block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<?php
global $postSeq, $RPRHAG_category;

if(is_home() || is_front_page()){
    get_template_part( 'content', 'homepage' );
} elseif (is_category()) {
    if ($RPRHAG_category[0]->cat_ID === get_cat_ID('Homepage')) {
        get_template_part( 'content', 'homepage' );
    }
}

$showArticle = get_post_meta(get_the_ID(), 'RPRHAG_post_show_article', true);
$showArticle = ((!$showArticle)?"Yes":$showArticle);
$showHeading = get_post_meta(get_the_ID(), 'RPRHAG_post_show_heading', true);
$showHeading = ((!$showHeading)?"Yes":$showHeading);

if ($showArticle === "Yes") { ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php } ?>
    <header>
        <?php if ($showHeading === "Yes") { ?>
        <h1><?php the_title(); ?></h1>
        <?php } ?>
    </header>
    <?php the_content(); ?>
    <footer>
    </footer>
<?php if ($showArticle === "Yes") { ?>
</article>
<?php } ?>