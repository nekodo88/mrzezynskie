	<div class="item-post">
		<div class="wrapp container">
		<div class="row">
		
			<div class="left-content col-md-4 col-sm-4 col-xl-12">
				<div class="wrap">
					<div class="thumb">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<span class="wrap-img"  style="background-image:url(<?php echo the_post_thumbnail_url(); ?>);">
					<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail('blog'); ?>
						<?php else: ?>
						<img src="<?php echo get_template_directory_uri()?>/images/img-default.jpg">
						<?php endif; ?>
					</span>
					</a>
					</div>
					<div class="author-share">
						<?php
							if(function_exists('beer_pub_social_share')){
							   beer_pub_social_share();
							}
						?>
						<div class="author"><span><?php _e('Author :', 'beer_pub'); ?></span> <?php the_author_posts_link(); ?></div>
					</div>
				</div>
			</div>
		
			<div class="right-content col-md-4 col-sm-4 col-xl-12">
				<div class="wrap">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
					<div class="meta"><span class="date"><?php echo get_the_date('F j Y'); ?></span><span class="comment"><?php echo '&lpar;'.get_comments_number().'&rpar;'; _e(' Comments','beer_pub');?></span></div>
					<p class="desc"><?php echo wp_trim_words( get_the_excerpt(), $num_words = 40, '' ) ?></p>
					<a class="read-more" href="<?php echo get_permalink(); ?>" title=""><?php echo _e('Continue Reading','beer_pub'); ?></a>
				</div>
			</div>
			</div>
		</div>
	</div>