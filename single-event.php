<?php
/*  Theme index.php
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<?php
    get_header();
    if ( have_posts() ) :
    ?><div class="articles"><?php
        while ( have_posts() ) : the_post();
?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <h1 class="event-date-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
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
<?php
        endwhile;
        ?></div><?php
    else:
?><p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php
    endif;
    
    get_footer();
?>
