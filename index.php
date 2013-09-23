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
            'posts_per_page' => 8,
            'post_type' => array('post','event')
        ));
    }
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            $postType = get_post_type(get_the_ID());
            
            if(is_home() || is_front_page()){
                if ($postType === 'post') {
                    if(in_category('Homepage')){
                        get_template_part( 'content', $postType );
                        $postSeq++;
                    }
                } elseif ($postType === 'event') {
                    $isInHompageCategory = false;
                    $categories = get_the_terms(get_the_ID(), 'event-category');
                    foreach ($categories as $category) {
                        if($category->name === 'Homepage') {
                            $isInHompageCategory = true;
                        }
                    }
                    
                    if ($isInHompageCategory) {
                        get_template_part( 'content', $postType );
                        echo get_post_format();
                        $postSeq++;
                    }
                }
            }else{
                get_template_part( 'content', $postType );
                $postSeq++;
            }
        endwhile;
    else:
?><p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php
    endif;
    ?></div><?php
    get_footer();
?>
