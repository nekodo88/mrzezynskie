<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div class="container">
 *
 * @package Pub Store
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} else {
		do_action( 'wp_body_open' );
	}
?>
<a class="skip-link screen-reader-text" href="#ps_page_wrapper">
<?php esc_html_e( 'Skip to content', 'pub-store' ); ?>
</a>
<?php
$pub_store_homeslideshowoption 	  		    = get_theme_mod('pub_store_homeslideshowoption', false);
$pub_store_ourftr_showpanel 	  	        = get_theme_mod('pub_store_ourftr_showpanel', false);
$show_pub_store_welcomepage	                = get_theme_mod('show_pub_store_welcomepage', false);
$pub_store_anable_social 	  			    = get_theme_mod('pub_store_anable_social', false);
?>
<div id="sitelayout_type" <?php if( get_theme_mod( 'pub_store_boxlayout_option' ) ) { echo 'class="boxlayout"'; } ?>>
<?php
if ( is_front_page() && !is_home() ) {
	if( !empty($pub_store_homeslideshowoption)) {
	 	$inner_cls = '';
	}
	else {
		$inner_cls = 'siteinner';
	}
}
else {
$inner_cls = 'siteinner';
}
?>

<div class="site-header <?php echo esc_attr($inner_cls); ?>"> 
<div class="container">    
     <div class="logo">
        <?php pub_store_the_custom_logo(); ?>
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php $description = get_bloginfo( 'description', 'display' );
            if ( $description || is_customize_preview() ) : ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div><!-- logo -->
     <div class="psright_wrap">
       <div class="toggle">
         <a class="toggleMenu" href="#"><?php esc_html_e('Menu','pub-store'); ?></a>
       </div><!-- toggle --> 
       <div class="mainmenu">                   
         <?php wp_nav_menu( array('theme_location' => 'primary') ); ?>
       </div><!--.mainmenu -->
     </div><!--.psright_wrap -->
<div class="clear"></div>  
</div><!-- container --> 
</div><!--.site-header --> 

<?php 
if ( is_front_page() && !is_home() ) {
if($pub_store_homeslideshowoption != '') {
	for($i=1; $i<=3; $i++) {
	  if( get_theme_mod('pub_store_homeslide'.$i,false)) {
		$slider_Arr[] = absint( get_theme_mod('pub_store_homeslide'.$i,true));
	  }
	}
?> 
<div class="slider_section">                
<?php if(!empty($slider_Arr)){ ?>
<div id="slider" class="nivoSlider">
<?php 
$i=1;
$slidequery = new WP_Query( array( 'post_type' => 'page', 'post__in' => $slider_Arr, 'orderby' => 'post__in' ) );
while( $slidequery->have_posts() ) : $slidequery->the_post();
$image = wp_get_attachment_url( get_post_thumbnail_id($post->ID)); 
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true); 
?>
<?php if(!empty($image)){ ?>
<img src="<?php echo esc_url( $image ); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php }else{ ?>
<img src="<?php echo esc_url( get_template_directory_uri() ) ; ?>/images/slides/slider-default.jpg" title="#slidecaption<?php echo esc_attr( $i ); ?>" alt="<?php echo esc_attr($alt); ?>" />
<?php } ?>
<?php $i++; endwhile; ?>
</div>   

<?php 
$j=1;
$slidequery->rewind_posts();
while( $slidequery->have_posts() ) : $slidequery->the_post(); ?>                 
    <div id="slidecaption<?php echo esc_attr( $j ); ?>" class="nivo-html-caption">        
    	<h2><?php the_title(); ?></h2>
    	<?php the_excerpt(); ?>
    <?php
    $pub_store_homeslidemore = get_theme_mod('pub_store_homeslidemore');
    if( !empty($pub_store_homeslidemore) ){ ?>
    	<a class="slide_more" href="<?php the_permalink(); ?>"><?php echo esc_html($pub_store_homeslidemore); ?></a>
    <?php } ?>       
    </div>   
<?php $j++; 
endwhile;
wp_reset_postdata(); ?>  
<div class="clear"></div>  
</div><!--end .slider_section -->     
<?php } ?>
<?php } } ?>
       
        
<?php if ( is_front_page() && ! is_home() ) {
if( $pub_store_ourftr_showpanel != ''){ ?>  
<section id="ps_3col_wrapper">
<div class="container">                      
<?php 
for($n=1; $n<=3; $n++) {    
if( get_theme_mod('pub_store_ourftrpage'.$n,false)) {      
	$queryvar = new WP_Query('page_id='.absint(get_theme_mod('pub_store_ourftrpage'.$n,true)) );		
	while( $queryvar->have_posts() ) : $queryvar->the_post(); ?> 
    
	<div class="ps_3colbx <?php if($n % 3 == 0) { echo "last_column"; } ?>">                                    
		<?php if(has_post_thumbnail() ) { ?>
		<div class="ps_thumbbx"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail();?></a></div>
		<?php } ?>
		<div class="ps_contentbx">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>                                     
		<?php the_excerpt(); ?>
		 <a class="learnmore" href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','pub-store'); ?></a>                                  
		</div>                                   
	</div>
	<?php endwhile;
	wp_reset_postdata();                                  
} } ?>                                 
<div class="clear"></div>  
</div><!-- .container -->                  
</section><!-- #ps_3col_wrapper-->                      	      
<?php } ?>


<?php if( $show_pub_store_welcomepage != ''){ ?>  
<section id="ps_welcome_section">
<div class="container">                               
<?php 
if( get_theme_mod('pub_store_welcomepage',false)) {     
$queryvar = new WP_Query('page_id='.absint(get_theme_mod('pub_store_welcomepage',true)) );			
    while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>                              
     <div class="ps_welcontent_bx">   
     <h3><?php the_title(); ?></h3>   
     <?php the_content(); ?>     
    </div> 
    <div class="ps_welcome_imgbx"><?php the_post_thumbnail();?></div>                                        
    <?php endwhile;
     wp_reset_postdata(); ?>                                    
    <?php } ?>                                 
<div class="clear"></div>                       
</div><!-- container -->
</section><!-- #ps_welcome_section-->
<?php } ?>
<?php } ?>