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
    ?><div class="articles"><?php
    if(is_home() || is_front_page() || in_category('Homepage')){
        query_posts(array(
            'orderby' => 'meta_value_num',
            'meta_key' => 'RPRHAG_post_order',
            'order' => 'ASC',
            'posts_per_page' => 8
        ));
    }
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            if(is_home() || is_front_page()){
                if(in_category('Homepage')){
                    get_template_part( 'content', get_post_format() );
                }
            }else{
                get_template_part( 'content', get_post_format() );
            }
            
            $postSeq++;
        endwhile;
    else:
?><p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php
    endif;
    ?></div><?php
    get_footer();
?>
