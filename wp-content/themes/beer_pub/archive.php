<?php get_header(); ?>
	<div class="blog-post">			
		<div id="primary" class="content-area">
			<div class="main-blog-post">
					<?php if ( have_posts() ) : ?>
	
						<div class="load-item_v1">
							<?php
							// Start the loop.
							while ( have_posts() ) : the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'templates/content', get_post_format() );

							// End the loop.
							endwhile; ?>
						</div>
						<?php 
							$beer_pub_show_loadmore = get_theme_mod('show_loadmore_blog','no');
							$current_page = get_query_var('paged') ? intval(get_query_var('paged')) : 1;	
						?>
						<?php if ($beer_pub_show_loadmore == 'yes'): ?>
							<?php if ($wp_query->max_num_pages > 1) : ?>
								<div class="col-md-12 col-sm-12 col-xs-12">				
									<?php if (get_next_posts_link()) { ?>
										<div class="load-more">
											<div class="load_more_button">
												<p data-paged="<?php echo esc_attr($current_page) ?>" data-totalpage="<?php echo esc_attr($wp_query->max_num_pages) ?>">
													<?php echo get_next_posts_link(__('Load more', 'beer_pub')); ?>
												</p>
											</div>
										</div>
									<?php } ?>
								</div>					
							<?php endif; ?>
						<?php else:?>
							<div class="pagination-content text-center">
								<?php beer_pub_pagination(); ?>
							</div>
						<?php endif; ?>
		
					<?php
					// If no content, include the "No posts found" template.
					else :
						get_template_part( 'templates/content', 'none' );

					endif;
					?>
				</div>
		</div> <!-- End primary -->
	</div>
<?php get_footer(); ?> 