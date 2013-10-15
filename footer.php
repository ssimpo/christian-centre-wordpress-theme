<?php
/*  Theme main footer block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<footer>
    <aside class="content">
		<div
			data-dojo-type="rprhag/maps/expandingMap"
			class="map"
		></div>
        <div style="height:5px;line-height: 5px;">&nbsp;</div>
        <?php
            $query =  array(
                'category_name' => 'Footer',
                'orderby' => 'meta_value_num',
                'meta_key' => 'RPRHAG_post_order',
                'order' => 'ASC'
            );
            $items = new WP_Query( $query );
            if( $items->have_posts() ):
                while ( $items->have_posts() ) : $items->the_post();
                    ?><h2><?php echo the_title(); ?></h2><?
                    echo the_content();
                endwhile;
            endif;
            wp_reset_postdata();
        ?>
		<div class="find-us-block">
			<a href="http://facebook.com/christiancentre">
				<img src="<?php echo get_template_directory_uri(); ?>/media/images/logos/facebook.png" width="64" height="64" alt="Facebook Logo" id="facebookLogoLink" />
			</a>
			<a href="http://twitter.com/thechristiancen">
				<img src="<?php echo get_template_directory_uri(); ?>/media/images/logos/twitter.png" width="64" height="64" alt="Twitter Logo" id="twitterLogoLink" />
			</a>
		</div>
		<div class="clear">&nbsp;</div>
	</aside>
    <?php wp_footer(); ?>
    <?php include_once("includes/piwiktracking.php"); ?>
</footer>
</div>
<?php get_sidebar(); ?>
</div>
</body>
</html>