<?php
/*  Theme homepage slideshow.
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<?php global $postSeq; ?>
<?php if ($postSeq === 0){?>
<div
	data-dojo-type="simpo/widget/slideshow"
	data-dojo-props="src:[<?php
			$slideShowIds = array(
				526,544,543,521,528,522,524,529,525,523,527,531,545,542,530
			);
			
			for($i = 0; $i < count($slideShowIds); $i++) {
				$slideShowIds[$i] = "'" . wp_get_attachment_url($slideShowIds[$i]) . "'";
			}
			
			echo implode(',', $slideShowIds);
	?>], type:'squares', squaresSize:36, interval:2500"
	class="simpoSlideshow homepageSlideshow"
></div>
<?php } ?>