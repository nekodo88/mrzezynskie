<?php
$ratesShow = get_theme_mod('rates_show','yes');
$ratesTitle = get_theme_mod('title_rates','~ Our Beer Lists & Rates ~');
$ratesSubtitle = get_theme_mod('sub_title_rates','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.');
$ratesBackground = get_theme_mod('Background_rates',get_template_directory_uri() . '/images/rate-bg.jpg');
$ratesImg = get_theme_mod('img_rates',get_template_directory_uri() . '/images/rate-separate.png');
//mullti
$customizer_repeater_rates = get_theme_mod("customizer_repeater_rates");
$customizer_repeater_example_decoded = json_decode($customizer_repeater_rates);

$caterates = get_theme_mod('rates_category','');
$cateratesLimit = get_theme_mod('rates_number_post',3);
$args = array(
    'posts_per_page'   => $cateratesLimit,
    'offset'           => 0,
    'cat'         => $caterates,
    'order' => 'ASC',
    'post_type'        => 'testimonial',
);
$posts_array = get_posts( $args );
?>
<?php if($ratesShow):?>
<section id="rates" style="background-image: url('<?php echo $ratesBackground?>')">
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="wrap-beer-lists">
                    <div class="inner-beer-lists">
                        <div class="wrap-title-list text-center">
                            <div class="beer-lists-title">
                                <h3 class="text-capitalize"><?php echo $ratesTitle?></h3>
                            </div>
                            <div class="beer-lists-content title-content">
                                <p><?php echo $ratesSubtitle?></p>
                            </div>
                        </div>
                        <div class="wrap-menu-lists">
                    <?php foreach ($customizer_repeater_example_decoded as $item): ?>
                            <div class="menu-lists">
                                <div class="beer d-flex">
                                    <div class="beer-name"><a class="text-capitalize" href="<?php echo $item->link?>"><?php echo $item->title?></a></div>
                                    <div class="beer-price">
                                        <p class="m-0"><?php echo $item->text?></p>
                                    </div>
                                </div>
                                <div class="beer-content">
                                    <p><?php echo $item->subtitle?></p>
                                    <p><?php echo $item->text?></p>
                                </div>
                            </div>
                        <?php endforeach; wp_reset_postdata();?>

                        </div>
                        <div class="wrap-separate text-center"><img src="<?php echo $ratesImg?>"></div>
                        <div class="wrap-rate-slide">

                        <?php foreach ($posts_array as $_post): setup_postdata( $_post );?>

                            <div class="rate-content text-center">
                                <div class="customer-rate">
                                    <p><?php echo get_the_excerpt($_post->ID) ?></p>
                                </div>
                                <div class="customer-name">
                                    <p class="text-capitalize"><?php echo get_the_title($_post->ID) ?></p>
                                </div>
                                <div class="customer-avatar"><?php echo get_the_post_thumbnail($_post->ID); ?></div>
                            </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>