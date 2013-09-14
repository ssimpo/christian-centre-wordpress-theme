<?php
/*  Theme home block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div
	    data-dojo-type="simpo/widget/slideshow"
		data-dojo-props="src:[
			themePath+'/media/images/slideshow/KayleighAndJosephine.jpg',
	        themePath+'/media/images/slideshow/LukeGreen.jpg',
	        themePath+'/media/images/slideshow/Banners.jpg',
	        themePath+'/media/images/slideshow/ChrisAndEloise.jpg',
	        themePath+'/media/images/slideshow/Geoff.jpg',
	        themePath+'/media/images/slideshow/Coffee.jpg',
	        themePath+'/media/images/slideshow/Luke.jpg',
	        themePath+'/media/images/slideshow/Stephen.jpg',
	        themePath+'/media/images/slideshow/Mal.jpg',
	        themePath+'/media/images/slideshow/Reception.jpg',
	        themePath+'/media/images/slideshow/Sarah.jpg'
	    ], type:'squares', squaresSize:36, interval:2500
	    "
	></div>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <?php the_content(); ?>
    <footer>
    </footer>
</article>