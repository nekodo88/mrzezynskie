<?php

get_header(); ?>


    <div id="primary" class="content-area">
        <div id="content" class="site-content page-404" role="main">
            <div class="page-content">
				<h1><?php esc_html_e( '404', 'beer_pub' ); ?></h1>
                <h3><?php esc_html_e( 'Not Found', 'beer_pub' ); ?></h3>
                <p><?php esc_html_e( 'Server cannot find the file you requested. The Page has either been moved or deleted, or you entered the wrong URL or document name. Look at the URL. If a word looks misspelled, then correct it and try it again. If that doesnt work You can try our search option to find what you are looking for.', 'beer_pub' ); ?></p>
            </div><!-- .page-content -->

        </div><!-- #content -->
    </div><!-- #primary -->

<?php
get_footer();
