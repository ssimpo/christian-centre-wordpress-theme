<?php
/*  Theme main content block
 *  
 *  @author Stephen Simpson <me@simpo.org>
 *  @version v0.1
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div
        class="dojoLhSlideshow"
style="float:left;margin-right:20px;background-image: url('<?php echo get_template_directory_uri(); ?>/media/images/slideshow/KayleighAndJosephine.jpg');"
	data-dojo-type="rprhag/slideshow2"
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
	],slices:25,width:350,height:350"
	></div>
    <header>
        <h1><?php the_title(); ?></h1>
    </header>
    <?php the_content(); ?>
    <footer>
    </footer>
</article>