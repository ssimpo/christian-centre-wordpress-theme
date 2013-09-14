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
		<h2>Location</h2>
		<p>The Christian Centre meets every Sunday in The Hazel Pearson Theatre at Middlesbrough College. If you're using SatNav, the postcode is: TS2 1AD.</p>
		<h2>Parking</h2>
		<p>Free parking is available at the front of the building and on the side-streets opposite (free on Sundays). The church has permission to use all the spaces within the College Campus on Sundays (included the spaces marked for permit holders).</p>
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
</footer>
</div>
<?php get_sidebar(); ?>
</div>
</body>
</html>