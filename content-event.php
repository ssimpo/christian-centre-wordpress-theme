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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h1 class="event-date-title"><?php the_title(); ?></h1>
        <p class="event-date-subtitle"><?php
            $current_occurance = eo_get_next_occurrence_of(get_the_ID());
            $start = $current_occurance['start']->format('jS M Y');
            $end = $current_occurance['end']->format('jS M Y');
            
            if ($start !== $end) {
                echo $start . ' - ' . $end;
            } else {
                $startTime = $current_occurance['start']->format('g:ia');
                $endTime = $current_occurance['end']->format('g:ia');
                
                echo $start . ' ' . $startTime . '-' . $endTime;
            }
           
        ?></p>
    </header>
    <?php the_content(); ?>
    
    
    
    <footer>
    </footer>
</article>