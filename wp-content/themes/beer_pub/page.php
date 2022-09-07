<?php get_header(); ?>		
	<div id="primary" class="content-area">
		<div class="container">
			<header class="entry-header">
				<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->		
			<div class="main-page">		
				<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'templates/content', 'page' ); ?>

						<?php	if ( comments_open() || get_comments_number() ) {
								comments_template();
								}
						?>				
				<?php endwhile; // End of the loop. ?>
			</div>
		</div>
	</div><!-- End primary -->
<?php get_footer(); ?>