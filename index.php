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

    if(function_exists('the_breadcrumbs')) {
        ?><span class="breadcrumb" xmlns:v="http://rdf.data-vocabulary.org/#"><?php the_breadcrumbs(); ?></span><?php
    }

    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            $postType = get_post_type(get_the_ID());
            
            if(is_home() || is_front_page()){
                if ($postType === 'post') {
                    if(in_category('Homepage')){
                        if($postSeq > 0) { ?><hr /><?php }
                        get_template_part( 'content', $postType );
                        $postSeq++;
                    }
                } elseif ($postType === 'event') {
                    $categories = get_the_terms(get_the_ID(), 'event-category');
                    if ($categories) {
                        $isInHompageCategory = false;
                        
                        foreach ($categories as $category) {
                            if(strtolower($category->name) === 'homepage') {
                                $isInHompageCategory = true;
                            }
                        }
                        
                        if ($isInHompageCategory) {
                            if($postSeq > 0) { ?><hr /><?php }
                            get_template_part( 'content', $postType );
                            echo get_post_format();
                            $postSeq++;
                        }
                    }
                }
            }else{
                if($postSeq > 0) { ?><hr /><?php }
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