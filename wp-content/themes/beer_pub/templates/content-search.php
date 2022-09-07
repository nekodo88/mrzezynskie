<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
        <?php $post_url = get_permalink();  ?>
        <h2><a href="<?php echo get_permalink(); ?>" class="item-title"><?php echo get_the_title(); ?></a></h2>
        <span class="date"><?php echo get_the_date(); ?></span>
        <div class="item-des"><?php echo get_the_excerpt(); ?></div>
	</div> <!-- End entry-content -->
</article> <!-- End post -->