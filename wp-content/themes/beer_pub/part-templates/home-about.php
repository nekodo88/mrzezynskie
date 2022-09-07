<?php
$aboutshow = get_theme_mod('about_show','yes');

$bgabout = get_theme_mod('background_about',get_template_directory_uri() . '/images/about-us.jpg');
$imgabout = get_theme_mod('img_bottom_about', get_template_directory_uri() . '/images/about-us-separator.png');
$titleabout = get_theme_mod('Title_about','~ Welcome to Craft Beer Pub ~');
$descabout = get_theme_mod('desc_about','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>');
$linkabout = get_theme_mod('link_about','#');
$titlelinkabout = get_theme_mod('Title_link_about','read more');

?>
<?php if ($aboutshow === 'yes'):?>
<section id="about-us" style="background-image: url('<?php echo $bgabout?>')">
    <div class="wrap-au-separator"><img src="<?php echo $imgabout?>"></div>
    <div class="container">
        <div class="row">
            <div class="col-8">
                <div class="wrap-au">
                    <div class="inner-au">
                        <div class="au-title text-sm-center">
                            <h3><?php echo $titleabout?></h3>
                        </div>
                        <div class="au-content title-content">
                            <?php echo $descabout?>
                        </div>
                        <div class="au-read-more "><a class="text-uppercase" href="<?php echo $linkabout?>"><?php echo $titlelinkabout?></a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>