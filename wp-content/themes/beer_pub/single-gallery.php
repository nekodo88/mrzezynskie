<?php get_header(); ?>			
	<div id="primary" class="content-area">
		<div class="container">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'templates/content', 'gallery' ); ?>
			<?php endwhile; // End of the loop. ?>
			<div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
				<?php
					// If comments are open or we have at least one comment, load up the comment template.
					 if ( comments_open() || get_comments_number() ) {
						//comments_template();
					 }			    
				?>
			</div>
		</div>
	</div> <!-- End primary -->
<?php get_footer(); ?>
