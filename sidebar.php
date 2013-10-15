<aside>
    <header style="border-bottom:1px solid #000000">
        <a href="/subscribe-to-news/" title="Sign-up to our email newsletter and notices">
            <img src="<?php echo get_template_directory_uri(); ?>/media/images/design/stayInTheKnow.png" width="226" height="150" alt="Stay in the know. Get the news. click to sign-up" />
        </a>
    </header><br />
    <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
    <?php endif; ?>
    <footer></footer>
</aside>