	<div class="top-blog">
		<?php if(get_the_title() != ''):?>
			<h1><?php echo get_the_title(); ?></h1>  
		<?php endif;?> 
		<div class="meta">
			<span class="date"><?php echo get_the_date('F j Y'); ?></span>
			<span class="social-share-post">
			<?php
				if(function_exists('beer_pub_social_share')){
					echo '<lable class="lable">'. wp_kses('Share :','beer_pub') .'</lable>';
					beer_pub_social_share();
				}
			?>	
			</span>
			<span class="comment"><?php echo '&lpar;'.get_comments_number().'&rpar;'; _e(' Comments','beer_pub');?></span>
		</div>				
	</div>
	<div class="content-blog">	
		<?php the_content();?>		
	</div>
	