<?php
/*  Theme main content block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<?php
    global $postSeq, $RPRHAG_category;
?>
<?php if(is_home() || is_front_page() || ($RPRHAG_category[0]->cat_ID === get_cat_ID('Homepage'))){
    get_template_part( 'content', 'homepage' );
}?>
<article id="post-<?php the_ID(); ?>" <?php post_class('hentry'); ?>>
    <header>
        <h1 class="event-date-title entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <p class="event-date-subtitle"><?php
            $current_occurance = eo_get_next_occurrence_of(get_the_ID());
            $start = $current_occurance['start']->format('jS M Y');
            $end = $current_occurance['end']->format('jS M Y');
            $htmlStartTime = $current_occurance['start']->format('Y-m-d G:i:s');
            $htmlEndTime = $current_occurance['end']->format('Y-m-d G:i:s');
            
            if ($start !== $end) {
                echo '<time datetime="'.$htmlStartTime.'">' . $start . '</time> - <time datetime="'.$htmlEndTime.'">' . $end .'</time>';
            } else {
                $startTime = $current_occurance['start']->format('g:ia');
                $endTime = $current_occurance['end']->format('g:ia');
                
                echo '<time datetime="'.$htmlStartTime.'">' . $start . ' ' . $startTime . '</time>-<time datetime="'.$htmlEndTime.'">' . $endTime . '</time>';
            }
           
        ?></p>
    </header>
    <!--<?php the_content(); ?>-->
    <?php the_excerpt(); ?>
    <p><a href="<?php the_permalink(); ?>">[More details ...]</a></p>
    
    
    <footer>
    </footer>
</article>