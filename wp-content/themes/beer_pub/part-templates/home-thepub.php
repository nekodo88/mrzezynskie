<?php
$ThePubShow = get_theme_mod('the_pub_show','yes');
$ThePubTitle = get_theme_mod('title_the_pub','~Feel The Taste of our Beer ~');
$ThePubSubtitle = get_theme_mod('sub_title_the_pub','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.');
$catethepub = get_theme_mod('The_pub_category','');
$catelimit = get_theme_mod('the_pub_number_post',3);
$args = array(
    'posts_per_page'   => $catelimit,
    'offset'           => 0,
    'cat'         => $catethepub,
    'order' => 'ASC',
    'post_type'        => 'post',
);
$posts_array = get_posts( $args );
?>
<?php if($ThePubShow): ?>
<section id="the-pub">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="wrap-the-pub-title">
                    <div class="inner-tp-title text-center">
                        <div class="tp-top-title">
                            <h3><?php echo $ThePubTitle?></h3>
                        </div>
                        <div class="tp-title-content title-content">
                            <p><?php echo $ThePubSubtitle?></p>
                        </div>
                    </div>
                </div>
                <div class="wrap-the-pub-feature">
                    <ul class="p-0 d-lg-flex justify-content-between">
                        <?php foreach ($posts_array as $_post): setup_postdata( $_post );?>
                        <li>
                            <div class="inner-feature text-center">
                                <div class="tp-feature-image"><a href="<?php echo get_post_permalink($_post->ID) ?>"><?php echo get_the_post_thumbnail($_post->ID); ?></a></div>
                                <div class="tp-title">
                                    <h3 class="text-capitalize"><a href="<?php echo get_post_permalink($_post->ID) ?>"><?php echo get_the_title($_post->ID) ?></a></h3>
                                </div>
                                <div class="tp-content">
                                    <p><?php echo get_the_excerpt($_post->ID) ?></p>
                                </div>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
 <?php endif; ?>