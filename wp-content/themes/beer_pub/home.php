<?php get_header(); ?>	
<?php global $wp_query ?>
	<div id="primary" class="content-area">
		<div class="container">				
			<div class="top-blog">
				<?php if (get_theme_mod('blog_page_title','Blog Articles')) : ?>                       
						<h1 class="page-title"><?php echo get_theme_mod('blog_page_title','Blog Articles'); ?></h1>
				<?php endif; ?>
			</div>	
			<?php if ( have_posts() ) : ?>
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

			<?php if ($conference_show_loadmore == 'yes'): ?>
				<?php 
				if ($wp_query->max_num_pages > 1) : ?>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12 load-more-container">				
							<?php if (get_next_posts_link()) { ?>
								<div class="load-more">
									<div class="load_more_button">
										<p data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>">
											<?php echo get_next_posts_link(__('Load more', 'conference')); ?>
										</p>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>						
				<?php endif; ?>
			<?php else:?>
				<div class="pagination-content text-center">
					<?php beer_pub_pagination(); ?>
				</div>
			<?php endif; ?>
		</div>
	</div> <!-- End primary -->
<?php get_footer(); ?> 