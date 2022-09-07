<?php get_header(); ?>	
	<div id="primary" class="content-area">
		<div class="container">
			<div class="top-blog">
				<?php if (get_theme_mod('blog_page_title','Blog Articles')) : ?>                       
						<h1 class="page-title"><?php echo get_theme_mod('blog_page_title','Blog Articles'); ?></h1>
				<?php endif; ?>
			</div>	
			<?php if (have_posts() ) : ?>
				<div class="load-item_v1 blog-post-list">
					<?php
					while (have_posts()) : the_post();
						get_template_part( 'templates/content', '' );
					endwhile; ?>
				</div>

			<?php
			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'templates/content', 'none' );

			endif;
			?>
		</div>
	</div> <!-- End primary -->
<?php get_footer(); ?> 