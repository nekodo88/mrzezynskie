<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Pub Store
 */

get_header(); ?>

<div class="container">
    <div id="ps_page_wrapper">
        <section class="page_content_layout">
            <header class="page-header">
                <h1 class="entry-title"><?php esc_html_e( '404 Not Found', 'pub-store' ); ?></h1>                
            </header><!-- .page-header -->
            <div class="page-content">
                <p><?php esc_html_e( 'Looks like you have taken a wrong turn....Dont worry... it happens to the best of us.', 'pub-store' ); ?></p>  
            </div><!-- .page-content -->
        </section>
        <?php get_sidebar();?>       
        <div class="clear"></div>
    </div>
</div>
<?php get_footer(); ?>