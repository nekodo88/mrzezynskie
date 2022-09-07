<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) :?>
        <?php if (!empty(get_theme_mod('site_icon'))): ?>
            <link rel="shortcut icon" href="<?php echo esc_url(str_replace(array('http:', 'https:'), '', get_theme_mod('site_icon'))); ?>" type="image/x-icon" />
        <?php endif; ?>
    <?php endif;?>  
    <?php wp_head(); ?>
</head>
<?php
    $classAdminBar = is_admin_bar_showing() ? 'adminbar':'';
?>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
        <header class="header">
            <div class="header-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-8">
                            <div class="header-top">
                                <?php
                                $textLeft = get_theme_mod('text_left_header','<p class="m-0">1-800-234-5678</p> 
                                    <p class="m-0">info@craftbeers.com</p>');
                                $textRigth = get_theme_mod('text_right_header','<p class="m-0">6589 E.Florida Ave. Tampa, Florida 333689</p>')
                                ?>
                                <ul class="d-sm-flex justify-content-between">
                                    <li>
                                        <div class="wrap-header-info d-sm-block d-none">
                                            <?php echo  $textLeft?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap-header-info">
                                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                                <?php
                                                $logo_header = get_theme_mod('logo',get_template_directory_uri() . '/images/Craft-Beer-Pub.png');
                                                if ($logo_header && $logo_header!=''):
                                                    echo '<img class="logo-img"  src="' . esc_url(str_replace(array('http:', 'https:'), '', $logo_header)) . '" alt="' . esc_attr(get_bloginfo('name', 'display')) . '" />';
                                                else:
                                                    //bloginfo('name');
                                                endif;
                                                ?>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="wrap-header-info address-info d-sm-block d-none">
                                            <?php echo  $textRigth?>
                                        </div>
                                    </li>
                                </ul>
                                <div class="wrap-info-mobile d-sm-none d-block">
                                    <div class="wrap-header-info">
                                        <?php echo  $textLeft?>
                                    </div>
                                    <div class="wrap-header-info">
                                        <?php echo  $textRigth?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 d-flex flex-column justify-content-center col-2 p-0">
                            <?php
                            $bgmenu = get_theme_mod('Background_Menu',get_template_directory_uri() . '/images/menu-header-bg.png');
                            ?>
                            <div class="main-menu" style="background-image: url('<?php echo $bgmenu?>')">
                                <div class="open-menu-mobile d-lg-none">
                                    <div class="d-flex"><i class="fa fab fa-bars"></i></div>
                                </div>
                                <div class="menu-container">
                                    <nav class="main-navigation hide-mobile" id="site-navigation">
                                        <div class="close-menu-mobile"><i></i></div>
                                        <div class="menu-main-container">
                                            <?php
                                            if (has_nav_menu('primary')) {
                                                wp_nav_menu(array(
                                                        'theme_location' => 'primary',
                                                        'menu_class' => 'mega-menu',
                                                        'items_wrap' =>  '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                    )
                                                );
                                            }
                                            ?>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
   <?php

   $slidercategory = get_theme_mod('slider_category','');
   $sildernumberpost = get_theme_mod('silder_number_post',3);
   $args = array(
       'posts_per_page'   => $sildernumberpost,
       'offset'           => 0,
       'cat'         => $slidercategory,
       'order' => 'ASC',
       'post_type'        => 'Gallery',
   );
   $posts_array = get_posts( $args );
   ?>
        <div class="wrap-header-slide">

            <div class="slide-top">

                <?php foreach ($posts_array as $_post): setup_postdata( $_post );?>

                    <div class="rate-content text-center">
                        <div class="customer-bg" style="background-image: url('<?php echo get_the_post_thumbnail_url($_post->ID) ?>')">
                        <div class="customer-title">
                            <h2 class="text-capitalize"><?php echo get_the_title($_post->ID) ?></h2>
                            <p><?php echo get_the_excerpt($_post->ID) ?></p>
                        </div>
                    </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

        <div id="main" class="wrapper">
				
            

                    
        
       
