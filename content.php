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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
<!--<?php
echo get_post_type( get_the_ID() );
echo get_the_author_meta('display_name');

?>-->
<?php } ?>
    <header>
        <?php if ($showHeading === "Yes") { ?>
        <h1 itemprop="name"><?php the_title(); ?></h1>
        <?php if (get_post_type(get_the_ID()) == "post"){
            ?><span class="sml" style="font-size:0.8em"><b>Author:</b> <a href="/authors/<?php echo str_replace(' ', '-', strtolower(get_the_author_meta('display_name'))); ?>" rel=author" itemprop="author" itemscope itemtype="http://schema.org/Person"><span itemprop="name"><?php echo get_the_author_meta('display_name'); ?><span></a></span><?php
        }
        ?>
        <?php } ?>
    </header>
    <?php the_content(); ?>
    <footer>
    </footer>
<?php if ($showArticle === "Yes") { ?>
</article>
<?php } ?>