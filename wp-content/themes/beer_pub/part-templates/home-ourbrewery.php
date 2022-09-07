<?php
$ourbreweryShow = get_theme_mod('our_brewery_show','yes');
$ourbreweryTitle = get_theme_mod('title_our_brewery','~We serve variety of Beers~');
$ourbrewerySubTitle= get_theme_mod('sub_title_our_brewery','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.');
$ourbreweryImg = get_theme_mod('img_title',get_template_directory_uri() . '/images/our-brewery-separator.png');
$ourbreweryBacground = get_theme_mod('Background_our_brewery',get_template_directory_uri() . '/images/our-brewery.jpg');
$cateourbrewerythepub = get_theme_mod('our_brewery_category','');
$cateourbrewerylimit = get_theme_mod('our_brewery_number_post',4);
$args = array(
    'posts_per_page'   => $cateourbrewerylimit,
    'offset'           => 0,
    'cat'         => $cateourbrewerythepub,
    'order' => 'ASC',
    'post_type'        => 'post',
);
$posts_array = get_posts( $args );
?>
<?php if ($ourbreweryShow):?>
<section id="our-brewery" style="background-image: url('<?php echo $ourbreweryBacground?>')">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="wrap-brewery-title">
                    <div class="inner-brewery-title text-center">
                        <div class="brewery-title">
                            <h3><?php echo $ourbreweryTitle?></h3>
                        </div>
                        <div class="brewery-content title-content">
                            <p><?php echo $ourbrewerySubTitle?></p>
                        </div>
                    </div>
                </div>
                <div class="wrap-brewery">
                    <ul class="p-0 d-lg-flex justify-content-between">
    <?php foreach ($posts_array as $_post): setup_postdata( $_post );?>
                        <li>
                            <div class="inner-brewery text-center">
                                <div class="beer-type">
                                    <div class="beer-type-image"><a href="<?php echo get_post_permalink($_post->ID) ?>"><?php echo get_the_post_thumbnail($_post->ID); ?></a></div>
                                    <div class="beer-type-name">
                                        <h3 class="m-0 text-capitalize"><a href="<?php echo get_post_permalink($_post->ID) ?>"><?php echo get_the_title($_post->ID) ?></a></h3>
                                    </div>
                                    <div class="beer-type-separator"><img src="<?php echo $ourbreweryImg?>"></div>
                                    <div class="beer-type-content">
                                        <p><?php echo get_the_excerpt($_post->ID) ?></p>
                                    <div class="beer-type-read-more"><a href="<?php echo get_post_permalink($_post->ID) ?>"><img src="<?php echo get_template_directory_uri()?>/images/active-arrow.png"></a></div>
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
<?php endif?>