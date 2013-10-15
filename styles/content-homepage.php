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
	data-dojo-props="src:[
		themePath+'/media/images/slideshow/KayleighAndJosephine.jpg',
	    themePath+'/media/images/slideshow/LukeGreen.jpg',
		themePath+'/media/images/slideshow/MiddlesbroughCollege.jpg',
	    themePath+'/media/images/slideshow/Banners.jpg',
		themePath+'/media/images/slideshow/Luke.jpg',
		themePath+'/media/images/slideshow/BottleOfNotes.jpg',
	    themePath+'/media/images/slideshow/ChrisAndEloise.jpg',
		themePath+'/media/images/slideshow/Kids.jpg',
	    themePath+'/media/images/slideshow/Geoff.jpg',
	    themePath+'/media/images/slideshow/Coffee.jpg',
		themePath+'/media/images/slideshow/GeoffTea.jpg',
	    themePath+'/media/images/slideshow/Stephen.jpg',
		themePath+'/media/images/slideshow/Mal.jpg',
		themePath+'/media/images/slideshow/MiddlesbroughCollegeSign.jpg',
	    themePath+'/media/images/slideshow/Sarah.jpg'
	], type:'squares', squaresSize:36, interval:2500"
	class="simpoSlideshow homepageSlideshow"
></div>
<?php } ?>