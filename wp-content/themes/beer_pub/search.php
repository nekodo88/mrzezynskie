<?php get_header(); ?>
	<div class="page-search">			
		<div id="primary" class="content-area">
			
             <?php if (have_posts()): ?> 
				<div class="container">			 
					<?php while ( have_posts() ) : the_post(); ?>  

								<?php get_template_part( 'templates/content', 'search' ); ?>

					<?php endwhile; ?>
					
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
				</div>				
             <?php else: ?> 
			    <article id="post-0" class="post no-results not-found">
			        <div class="container">
			            <h1 class="entry-title not-found-title"><?php echo esc_html__('Nothing Found', 'beer_pub'); ?></h1>
			            <div class="row">
			                <div class="entry-content">
			                    <div class="col-md-12 col-sm-12 col-xs-12">
			                        <p><?php echo esc_html__('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'beer_pub'); ?></p>
			                        <div class="widget widget_search">
			                        <?php get_search_form(); ?>
			                        </div>
			                    </div>
			                </div><!-- .entry-content -->
			            </div>
			        </div>
			    </article><!-- #post-0 -->
             <?php endif; ?>
		</div> <!-- End primary -->
	</div>
<?php get_footer(); ?>