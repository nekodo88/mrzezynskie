<?php
$blogShow = get_theme_mod('blog_show','yes');
$blogTitle = get_theme_mod('Bolg_title','~ Lates Posts from Blog ~');
$blogSubtitle = get_theme_mod('blog_sub_title','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.');
$blogcate = get_theme_mod('blog_category','');
$bloglimit = get_theme_mod('blog_number_post',3);
$args = array(
    'posts_per_page'   => $bloglimit,
    'offset'           => 0,
    'cat'         => $blogcate,
    'order' => 'ASC',
    'post_type'        => 'post',
);
$posts_array = get_posts( $args );
?>
<?php if($blogShow):?>
<section id="blog">
    <div class="container">
        <div class="row text-center">
            <div class="col-8">
                <div class="wrap-blog-title">
                    <div class="blog-title">
                        <h3><?php echo $blogTitle?></h3>
                    </div>
                    <div class="blog-content title-content">
                        <p><?php echo $blogSubtitle?></p>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="wrap-blog-post">
    <?php foreach ($posts_array as $_post): setup_postdata( $_post );?>
                    <div class="inner-blog-post">
                        <div class="post-date">
                            <p>--- <?php echo get_the_date( 'j M, Y' );?> ---</p>
                        </div>
                        <div class="post-title">
                            <p><?php echo get_the_title($_post->ID)?></p>
                        </div>
                        <div class="post-continue-read"><a class="text-capitalize" href="<?php echo get_post_permalink($_post->ID) ?>">continue reading</a></div>
                    </div>
    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>