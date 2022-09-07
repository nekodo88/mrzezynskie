<?php
require_once(beer_pub_FUNCTIONS . '/ajax_search/ajax-search.php');
// Compatible WPML (Add wpml option)
require_once(beer_pub_FUNCTIONS . '/post_like_count.php');

if(!function_exists('beer_pub_social_share')){
    function beer_pub_social_share(){ ?>
	   <ul class="social-share">
			<?php if(get_theme_mod('share_facebook','yes') == 'yes'):?>
				<li><a target="_blank" class="fb" href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-facebook-square"></i></a></li>
			<?php endif;?>	
			<?php if(get_theme_mod('share_instagram','yes') == 'yes'):?>
				<li><a target="_blank" class="inta" href="https://api.instagram.com/?url=<?php the_permalink(); ?>"  onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-instagram"></i></a></li>
			<?php endif;?>
			<?php if(get_theme_mod('share_twitter','yes') == 'yes'):?>
				<li><a target="_blank" class="tw" href="https://twitter.com/share?url=<?php the_permalink(); ?>&amp;hashtags=seoiz" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-twitter-square"></i></a></li>
			<?php endif;?>
			<?php if(get_theme_mod('share_pinterest','yes') == 'no'):?>
				<li><a target="_blank" class="pin" href="http://www.pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>"  onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-pinterest"></i></a></li>
			<?php endif;?>
			<?php if(get_theme_mod('share_google','yes') == 'yes'):?>
				<li><a target="_blank" class="gg" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-google-plus"></i></a></li>
			<?php endif;?>
			<?php if(get_theme_mod('share_linkedin','yes') == 'yes'):?>
				<li><a target="_blank" class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'mywin','left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" ><i class="fab fa-linkedin"></i></a></li>
			<?php endif;?>
		</ul>
	<?php 
    }    
}

if(!function_exists('beer_pub_social_link')){
    function beer_pub_social_link(){
         if (get_theme_mod('facebook','#')!='' || get_theme_mod('instagram','#')!='' || get_theme_mod('twitter','#') !='' || get_theme_mod('google','#') !='' || get_theme_mod('linkedin','#') !='' ) : ?>
               <ul class="social-link">
                   <?php if(get_theme_mod('facebook','#')!=''):?>
                       <li><a target="_blank" class="fb" href="<?php echo esc_url(get_theme_mod('facebook'));?>" ><i class="fab fa-facebook-f"></i></a></li>
                   <?php endif;?>
                    <?php if(get_theme_mod('twitter','#') !=''):?>
                        <li><a target="_blank" class="tw" href="<?php echo esc_url(get_theme_mod('twitter'));?>" ><i class="fab fa-twitter"></i></a></li>
                    <?php endif;?>
                    <?php if(get_theme_mod('youtube','#')!=''):?>
                        <li><a target="_blank" class="inta" href="<?php echo esc_url(get_theme_mod('instagram'));?>" ><i class="fab fa-youtube"></i></a></li>
                    <?php endif;?>					
                    <?php if(get_theme_mod('pinterest','#') !=''):?>
                        <li><a target="_blank" class="gg" href="<?php echo esc_url(get_theme_mod('google'));?>" ><i class="fab fa-pinterest-p"></i></a></li>
                    <?php endif;?>
                    <?php if(get_theme_mod('google','#') !=''):?>
                        <li><a target="_blank" class="linkedin" href="<?php echo esc_url(get_theme_mod('linkedin'));?>" ><i class="fab fa-google-plus-g"></i></a></li>
                    <?php endif;?>
                </ul>
        <?php endif;   
    }    
}
if(!function_exists('beer_pub_social_link_2')){
    function beer_pub_social_link_2(){
        if (get_theme_mod('facebook','#')!='' || get_theme_mod('instagram','#')!='' || get_theme_mod('twitter','#') !='' || get_theme_mod('google','#') !='' || get_theme_mod('linkedin','#') !='' ) : ?>

                <?php if(get_theme_mod('facebook','#')!=''):?>
                    <a target="_blank" class="fb" href="<?php echo esc_url(get_theme_mod('facebook'));?>" ><i class="fab fa-facebook"></i></a>
                <?php endif;?>
                <?php if(get_theme_mod('twitter','#') !=''):?>
                    <a target="_blank" class="tw" href="<?php echo esc_url(get_theme_mod('twitter'));?>" ><i class="fab fa-twitter-square"></i></a>
                <?php endif;?>
                <?php if(get_theme_mod('pinterest','#') !=''):?>
                    <a target="_blank" class="pinterest" href="<?php echo esc_url(get_theme_mod('pinterest'));?>" ><i class="fab fa-pinterest-square"></i></a>
                <?php endif;?>
                <?php if(get_theme_mod('google','#') !=''):?>
                    <a target="_blank" class="linkedin" href="<?php echo esc_url(get_theme_mod('linkedin'));?>" ><i class="fab fa-linkedin"></i></a>
                <?php endif;?>

        <?php endif;
    }
}

if(!function_exists('beer_pub_get_relatedpost')){
    function beer_pub_get_relatedpost() {
        if(get_theme_mod('blog_single_related','yes')): ?>
                <?php                    
                    global $post;
                    $orig_post = $post;
                    $categories = wp_get_post_categories($post->ID);
                    if ($categories) :
                        $categories_ids = array();
                        foreach($categories as $individual_categories) {
                            if (isset($individual_categories->term_id)) {
                              $categories_ids[] = $individual_categories->term_id;

                            }
                        }
                        $args=array(
                            'tag__in' => $categories_ids,
                            'post__not_in' => array($post->ID),
                            'posts_per_page'=>3, // Number of related posts to display.
                            'ignore_sticky_posts '=>0,
                        );
                        $my_query = new wp_query( $args );
                        if ($my_query->have_posts()): ?>
                            <div class="related-posts">
                                <h3><span><?php echo esc_html__('Read Related Posts','beer_pub')?></span></h3>
                                <div class="wrapp row">
                                    <?php    
                                        while( $my_query->have_posts() ):
                                            $my_query->the_post();
                                    ?>
                                        <?php  if (!is_sticky()):?>  
										<div class="item-post col-xl col-md-4">
											<div class="wrapp">
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('blog'); ?></a></div>
											<?php endif; ?>
												<div class="wrap-content">
													<div class="wrap">
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<p class="desc"><?php echo wp_trim_words( get_the_excerpt(), $num_words = 12, '' ) ?></p>
														<p class="meta"><?php echo _e('Written By &colon;','beer_pub'); ?> <span class="author"><?php the_author_posts_link(); ?></span> &sol; <?php the_time('d M'); ?></p>
													</div>
												</div>
											</div>
										</div>
                            <?php 
                                        endif; 
                                    endwhile;
                                endif;
                                $post = $orig_post;
                                wp_reset_query();
                                ?>
                                </div>
                            </div>
        <?php       
                        endif;
       endif;
    }
}

function beer_pub_pagination($max_num_pages = null) {
    global $wp_query, $wp_rewrite;

    $max_num_pages = ($max_num_pages) ? $max_num_pages : $wp_query->max_num_pages;

    // Don't print empty markup if there's only one page.
    if ($max_num_pages < 2) {
        return;
    }

    $paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $query_args = array();
    $url_parts = explode('?', $pagenum_link);

    if (isset($url_parts[1])) {
        wp_parse_str($url_parts[1], $query_args);
    }

    $pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);
    $pagenum_link = trailingslashit($pagenum_link) . '%_%';

    $format = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    // Set up paginated links.
    $links = paginate_links(array(
        'base' => $pagenum_link,
        'format' => $format,
        'total' => $max_num_pages,
        'current' => $paged,
        'end_size' => 1,
        'mid_size' => 1,
        'prev_next' => true,
        'prev_text' => '<span class="prev-text">Previous Page</span>',
        'next_text' => '<span class="next-text">Next Page</span>',
        'type' => 'list'
            ));

    if ($links) :
        ?>
        <nav class="pagination">
            <?php echo wp_kses($links, beer_pub_allow_html()); ?>
        </nav>
        <?php
    endif;
}
/** 
    Add Back to Top button. 
*/
add_action( 'wp_footer', 'beer_pub_overlay' );
function beer_pub_overlay() {
    echo '<div class="overlay"></div>';
}

function beer_pub_get_attachment( $attachment_id, $size = 'full' ) {
    if (!$attachment_id)
        return false;
    $attachment = get_post( $attachment_id );
    $image = wp_get_attachment_image_src($attachment_id, $size);

    if (!$attachment)
        return false;

    return array(
        'alt' => esc_attr(get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true )),
        'caption' => esc_attr($attachment->post_excerpt),
        'description' => esc_html($attachment->post_content),
        'href' => get_permalink( $attachment->ID ),
        'src' => esc_url($image[0]),
        'title' => esc_attr($attachment->post_title),
        'width' => esc_attr($image[1]),
        'height' => esc_attr($image[2])
    );
}

//get search template
if ( ! function_exists( 'beer_pub_get_search_form' ) ) {
    function beer_pub_get_search_form() {
        global $beer_pub_settings;
        $template = get_search_form(false);  
        $output = '';
        ob_start();
        ?>
        <span class="btn-search search_button"><i class="fas fa-search"></i></span>      
        <div class="top-search content-filter">
            <?php echo wp_kses($template,beer_pub_allow_html()); ?>
        </div>      
        <?php
        $output .= ob_get_clean();
        return $output;
    }
}

if(!function_exists('beer_pub_get_sidebar_left')){
    function beer_pub_get_sidebar_left() {
        $result = '';
        global $wp_query, $beer_pub_sidebar_left;

        if (empty($beer_pub_sidebar_left)) {
            $result = get_theme_mod('sidebar_left');
            if (is_404()) {
                $result = '';
            } else if (is_category()) {
                $cat = $wp_query->get_queried_object();
                $cat_sidebar = get_metadata('category', $cat->term_id, 'left-sidebar', true);
                if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                    $result = $cat_sidebar;
                }else if($cat_sidebar =='none') {
                    $result = "none";
                } else {
                    $result = get_theme_mod('blog_sidebar_left');
                }
            }else if (is_tag()){
                $result = get_theme_mod('blog_sidebar_left');
            }else if (is_front_page()){
                $result = get_theme_mod('home_sidebar_left');
            }
            else if (is_search()){
                $result = get_theme_mod('blog_sidebar_left');
            }
            else {
                if (is_singular()) {
                    $single_sidebar = get_post_meta(get_the_id(), 'left-sidebar', true);
                    if (!empty($single_sidebar) && $single_sidebar != 'default') {
                        $result = $single_sidebar;
                    }else if($single_sidebar =='none') {
                        $result = "none";
                    } else {
                        switch (get_post_type()) {
                            case 'post':
                                $result = get_theme_mod('blog_sidebar_left');
                                break;    
                            default:
                                $result = get_theme_mod('sidebar_left');
                        }
                    }
                } else {
                    if (is_home() && !is_front_page()) {
                        $result = get_theme_mod('blog_sidebar_left');
                    }
                }
            }
            $beer_pub_sidebar_left = $result;
        }
        return $beer_pub_sidebar_left;
    }
}

if(!function_exists('beer_pub_get_sidebar_right')){
    function beer_pub_get_sidebar_right() {
        $result = '';
        global $wp_query,$beer_pub_sidebar_right;

        if (empty($beer_pub_sidebar_right)) {
            $result = get_theme_mod('sidebar_right','general-sidebar');
            if (is_404()) {
                $result = 'none';
            }else if (is_category()) {
                $cat = $wp_query->get_queried_object();
                $cat_sidebar = get_metadata('category', $cat->term_id, 'right-sidebar', true);
                if (!empty($cat_sidebar) && $cat_sidebar != 'default') {
                    $result = $cat_sidebar;
                }else if($cat_sidebar =='none') {
                    $result = "none";
                } else {
                    $result = get_theme_mod('blog_sidebar_right','general-sidebar');
                }
            }else if (is_tag()){
                $result = get_theme_mod('blog_sidebar_right');
            }else if (is_front_page()){
                $result = get_theme_mod('home_sidebar_right','general-sidebar');
            }else if (is_search()){
                $result = get_theme_mod('blog_sidebar_right');
            }else {
                if (is_singular()) {
                    $single_sidebar = get_post_meta(get_the_id(), 'right-sidebar', true);
                    if (!empty($single_sidebar) && $single_sidebar != 'default') {
                        $result = $single_sidebar;
                    }else if($single_sidebar =='none') {
                        $result = "none";
                    } else {
                        switch (get_post_type()) {
                            case 'post':
                                $result = get_theme_mod('blog_sidebar_right');
                                break;
                            default:
                                $result = get_theme_mod('sidebar_right','general-sidebar');
                        }
                    }
                } else {
                    if (is_home() && !is_front_page()) {
                        $result = get_theme_mod('blog_sidebar_right');
                    }
                }
            }
            $beer_pub_sidebar_right = $result;
        }
        return $beer_pub_sidebar_right;
    }
}

/*=====banner section in Homepage=======*/
if(!function_exists('beer_pub_banner_home')){
	function beer_pub_banner_home(){
		if(get_theme_mod('banner_show','yes')== 'yes'){
			$banner_title = get_theme_mod('banner_title','Divine Makeup <br>Cosmetology & <br>Beautification Services');
			$banner_sub_title = get_theme_mod('banner_sub_title','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor maximus eros sed vehicula. Aliquam ut iaculis odio');
			$button_banner = get_theme_mod('button_banner','Know More');
			$link_banner = get_theme_mod('link_banner','#');
			$background_banner = get_theme_mod('background_banner',get_template_directory_uri() . '/images/banner-home-img.jpg');
			?>
			<div class="section-banner" <?php if(!empty($background_banner)){ ?> style="background-image:url(<?php echo $background_banner; ?>);" <?php } ?>>
				<div class="container">
					<div class="wrapper">
						<?php if(!empty($banner_title)){ ?>
							<h2><?php echo $banner_title; ?></h2>
						<?php } ?>
						<?php if(!empty($banner_sub_title)){ ?>
							<p class="sub-title"><?php echo $banner_sub_title; ?></p>
						<?php } ?>
						<?php if(!empty($link_banner) || !empty($button_banner)){ ?>
							<a class="btn btn-default" href="<?php echo $link_banner; ?>"><?php echo $button_banner; ?></a>
						<?php } ?>
					</div>
				</div>
			</diV>
		<?php
		}
	}
}

/*=====about section in Homepage=======*/
if(!function_exists('beer_pub_about_home')){
	function beer_pub_about_home(){
		if(get_theme_mod('about_show','yes')== 'yes'){
			$title_about = get_theme_mod('title_about','About The Artist');
			$sub_title_about = get_theme_mod('sub_title_about','Sarah Mathew');
			$about_content = get_theme_mod('about_content','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Laoreet id donec ultrices tincidunt arcu non sodales neque. A diam sollicitudin tempor id eu. Cursus turpis massa tincidunt dui ut ornare lectus sit. Odio euismod lacinia at quis. Neque vitae tempus quam pellentesque nec nam.</p> 
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, neque. A diam sollicitudin tempor id eu. Cursus turpis massa tincidunt dui ut ornare lectus do eiusmod tempor incididunt ut labore et dolore magna aliqua. Laoreet id donec ultrices tincidunt arcu non sodales neque. A diam sollicitudin tempor id eu. Cursus turpis massa tincidunt dui ut ornare lectus sit....</p>');
			$about_image = get_theme_mod('about_image',get_template_directory_uri() . '/images/image-home.jpg');
			?>
			<div class="section section-about">
				<div class="container">
					<div class="row">
						<?php if(!empty($about_image)){ ?>
						<div class="col-md-4 col-sm-4 col-xs-12 image-left">
							<img src="<?php echo $about_image; ?>" alt="<?php echo $title_about; ?>" >
						</div>
						<?php } ?>					
						<div class="col-md-8 col-sm-8 col-xs-12">
						<?php if(!empty($sub_title_about)){ ?>
							<h3 class="sub-title"><?php echo $title_about; ?></h3>
						<?php } ?>							
						<?php if(!empty($title_about)){ ?>
							<h2><?php echo $sub_title_about; ?></h2>
						<?php } ?>
						<?php if(!empty($about_content)){ ?>
							<?php echo apply_filters( 'the_content', $about_content); ?>
						<?php } ?>
						</div>
					</div>
				</div>
			</diV>
		<?php
		}
	}
}

/*=====Services section in Homepage=======*/
if(!function_exists('beer_pub_services_home')){
	function beer_pub_services_home(){
		if(get_theme_mod('services_show','yes')== 'yes'){
			$shortcode_services = get_theme_mod('shortcode_services','[feature id="73"]');
			?>
			<div class="section section-services">
				<div class="container">
					<div class="wrapper">
						<?php if(!empty($shortcode_services)){ ?>
							<?php echo do_shortcode( $shortcode_services ); ?>
						<?php } ?>
					</div>
				</div>
			</diV>
		<?php
		}
	}
}

/*=====Gallery section in Homepage=======*/
if(!function_exists('beer_pub_gallery_home')){
	function beer_pub_gallery_home(){
		if(get_theme_mod('gallery_show','yes')== 'yes'){
			$title_gallery = get_theme_mod('title_gallery','Makeup Gallery');
			$sub_title_gallery = get_theme_mod('sub_title_gallery','Check the Works');
			?>
			<div class="section section-gallery">
				<div class="container">
					<div class="wrapper">
						<div class="top-section">
							<div class="left-title">
								<?php if(!empty($sub_title_gallery)){ ?>
									<h3 class="sub-title"><?php echo $sub_title_gallery; ?></h3>
								<?php } ?>
								<?php if(!empty($title_gallery)){ ?>
									<h2><?php echo $title_gallery; ?></h2>
								<?php } ?>
							</div>
							<div class="right-gallery-title">
								<?php 
								$terms = get_terms( array(
									'taxonomy' => 'gallery_cat',
									'orderby'    => 'ID', 
									'order'      => 'ASC',
									'hide_empty' => false
								) ); 
								if ( $terms ) { ?>
								<div class="gallery_header">
									<div class="gallery_filter">
										<div id="filters" class="button-group js-radio-button-group">
											<?php $j=0; foreach ( $terms as $key => $term ) : $j++; ?> 
												<div class="inline-block">
													<button class="btn-filter <?php if($j==1){ echo 'is-checked'; }; ?>" data-filter="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></button>
												</div>
											<?php endforeach;?>  
										</div>
									</div> 
								</div>  								
								<?php } ?>								
							</div>
						</div>
						<div class="tabs_sort gallery_sort">
							<?php if ( $terms ) { ?>
								<?php foreach ( $terms as $key => $term ) : ?>
								<div id="<?php echo $term->slug; ?>" class="wrap-row">							
								<?php							
									$the_query = new WP_Query(array(
										'post_type' => 'gallery',
										'posts_per_page' => 8,
										'post_status' => 'publish',
										'orderby'	=> 'date',
										'order'	=> 'DESC',
										'tax_query' => array(
											array (
												'taxonomy' => 'gallery_cat',
												'field' => 'slug',
												'terms' => $term->slug
											)
										),										
									));
									if ( $the_query->have_posts() ) : 
										while ( $the_query->have_posts() ) : $the_query->the_post(); 
										?>
											<?php if ( has_post_thumbnail() ) : ?>
												<div class="item"><a title="<?php the_title();?>" href="<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'beer_pub_blog', false);echo $image[0];//the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><span class="wrap-image" style="background-image:url(<?php echo $image[0];//echo the_post_thumbnail_url(); ?>);">
                                                <?php the_post_thumbnail('beer_pub_blog'); ?></span></a></div>
											<?php endif; ?>
									<?php
										endwhile;
									endif;
									wp_reset_postdata();									
								?>
								</div>
								<?php endforeach; ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</diV>
            <script>
            jQuery(document).ready(function($){
                $('.tabs_sort.gallery_sort #woman').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery:{
                        enabled:true
                    }
                });
                $('.tabs_sort.gallery_sort #men').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery:{
                        enabled:true
                    }
                });
                $('.tabs_sort.gallery_sort #children').magnificPopup({
                    delegate: 'a',
                    type: 'image',
                    gallery:{eader-container .me
                        enabled:true
                    }
                });
            })
            </script>
		<?php
		}
	}
}

/*=====Works section in Homepage=======*/
if(!function_exists('beer_pub_works_home')){
	function beer_pub_works_home(){
		if(get_theme_mod('on_work_show','yes')== 'yes'){
			$title_work = get_theme_mod('title_work','On the Show');
			$sub_title_work = get_theme_mod('sub_title_work','See How We Work');
			$work_content = get_theme_mod('work_content','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor inLaoreet id donec ultrices tincidunt arcu non sodales neque.');
			$link_video_work = get_theme_mod('link_video_work','https://www.youtube.com/watch?v=LgvseYYhqU0');
			$img_video_work = get_theme_mod('img_video_work',get_template_directory_uri() . '/images/image-video.jpg');
			?>
			<div class="section section-works">
				<div class="wrapper">
					<div class="col-md-7 col-sm-12 col-xs-12 no-padding left-section">
						<?php if(!empty($img_video_work) || !empty($link_video_work)){ ?>
							<div class="wrap-video" <?php if(!empty($img_video_work)){ ?> style="background-image:url(<?php echo $img_video_work; ?>);" <?php } ?>><div class="wrap-btn-video"><a class="btn-video" href="<?php echo $link_video_work; ?>"><i class="far fa-play-circle"></i></a></div></div>
						<?php } ?>
					</div>
					<div class="col-md-5 col-sm-12 col-xs-12 no-padding right-section">
						<?php if(!empty($sub_title_work)){ ?>
							<h3 class="sub-title"><?php echo do_shortcode( $sub_title_work ); ?></h3>
						<?php } ?>
						<?php if(!empty($title_work)){ ?>
							<h2><?php echo do_shortcode( $title_work ); ?></h2>
						<?php } ?>
						<?php if(!empty($work_content)){ ?>
							<?php echo apply_filters( 'the_content', $work_content); ?>
						<?php } ?>					
					</div>
				</div>
			</diV>
		<?php
		}
	}
}

/*----Got a blog... section in Homepage----*/
if(!function_exists('beer_pub_get_home_recent_blog')){
    function beer_pub_get_home_recent_blog() {
        global $wp_query,$post;
        if(get_theme_mod('blog_show','yes')== 'yes'):
			$number_post_blog = get_theme_mod('number_post_blog','3');
			$title_blog = get_theme_mod('title_blog','Blog Posts');
			$sub_title_blog = get_theme_mod("sub_title_blog","Read the Articles");
        ?>
            <div class="section section-blog">
                <div class="container">
					<div class="top-section">
						<?php  if($sub_title_blog !=''){ ?>
							<h3 class="sub-title"><?php echo $sub_title_blog; ?></h3>
						<?php } ?> 
						<?php  if($title_blog !=''){ ?>
							<h2><?php echo $title_blog; ?></h2>
						<?php } ?>
					</div>
					
					<?php if(!empty($number_post_blog)){ ?>
					<div class="blog-featured">
						<div class="wrapper">
								<?php
									$the_query = new WP_Query(array(
										'post_type' => 'post',
										'posts_per_page' => $number_post_blog,
										'post_status' => 'publish',
										'orderby'	=> 'date',
										'order'	=> 'DESC',
									));	
								?>	
								<?php if ( $the_query->have_posts() ) : 
									while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<div class="item-post">
											<div class="wrapp">
												<?php if ( has_post_thumbnail() ) : ?>
													<div class="thumb"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute('featured'); ?>"><span class="wrap-img"  style="background-image:url(<?php echo the_post_thumbnail_url(); ?>);"><?php the_post_thumbnail('featured'); ?></span></a></div>
												<?php endif; ?>
												<div class="wrap-content">
													<div class="wrap">
														<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
														<p class="meta"><span class="date"><?php echo get_the_date('F j, Y'); ?></span> &sol; <span class="author"><?php the_author_posts_link(); ?></span></p>
														<p class="desc"><?php echo wp_trim_words( get_the_excerpt(), $num_words = 23, '...' ) ?></p>
														<?php
															if(function_exists('beer_pub_social_share')){
															   beer_pub_social_share();
															}
														?>
													</div>
												</div>
											</div>
										</div>
								<?php endwhile;
								endif;
								wp_reset_postdata(); ?>
						</div>
					</div>  
					<?php } ?>
				</div>
            </div>
        <?php
           
        endif; 
    }
}

/*----testimonial... section in Homepage----*/
if(!function_exists('beer_pub_get_home_testimonials')){
    function beer_pub_get_home_testimonials() {
		if(get_theme_mod('testimonials_show','yes')== 'yes'){
			$testimonials_title = get_theme_mod('testimonials_title','Client Testimonials');
			$testimonials_sub_title = get_theme_mod('testimonials_sub_title','What Customers say');
			?>
			<div class="section section-testimonial">
                <div class="container">
					<?php  if($testimonials_sub_title !=''){ ?>
						<h3 class="sub-title"><?php echo $testimonials_sub_title; ?></h3>
					<?php } ?>
					<?php  if($testimonials_title !=''){ ?>
						<h2><?php echo $testimonials_title; ?></h2>
					<?php } ?>
					
					<?php
					$the_query = new WP_Query(array(
						'post_type' => 'testimonial',
						'posts_per_page' => 3,
						'post_status' => 'publish',
						'orderby'	=> 'date',
						'order'	=> 'DESC',
					));
					if ( $the_query->have_posts() ) : ?>
						<div class="testimonial-list">
							<div class="row">
							<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php $testimonial_position = get_post_meta( get_the_ID(), 'testimonial_position', true); ?>
								<div class="item-testimonial col-md-4 col-sm-4 col-sm-12">
									<div class="description"><?php the_content(); ?></div>
									<div class="avatar"><?php the_post_thumbnail('thumbnail'); ?></div>
									<p class="name"><?php the_title(); ?>
									<?php if(!empty($testimonial_position)){ ?>
										(<span class="position"><?php echo $testimonial_position; ?></span>)
									<?php } ?>
									</p>
								</div>			
							<?php endwhile; ?>
							</div>			
						</div>			
					<?php	
					endif;
					wp_reset_postdata();				
					?>
				</div>
			</div>
		<?php
		}
	}
}


/*----Got a Pricing... section in Homepage----*/
if(!function_exists('beer_pub_get_home_pricing')){
    function beer_pub_get_home_pricing() {
		if(get_theme_mod('pricing_show','yes')== 'yes'){
			$pricing_title = get_theme_mod('pricing_title','Service Rate Chart');
			$pricing_sub_title = get_theme_mod('pricing_sub_title','Pricing Details');
			$img_pricing = get_theme_mod('img_pricing',get_template_directory_uri() . '/images/image-home-7.jpg');
			$customizer_repeater_pricing = get_theme_mod("customizer_repeater_pricing");
			?>
			<div class="section section-pricing">
                <div class="container">
					<?php  if($pricing_sub_title !=''){ ?>
						<h3 class="sub-title"><?php echo $pricing_sub_title; ?></h3>
					<?php } ?>
					<?php  if($pricing_title !=''){ ?>
						<h2><?php echo $pricing_title; ?></h2>
					<?php } ?>
					<div class="pricing-wrap">
                    <?php 
						if(!empty($customizer_repeater_pricing)){
							echo '<div class="col-left"><ul class="pricing-list">';
							$customizer_repeater_example_decoded = json_decode($customizer_repeater_pricing);
							foreach( $customizer_repeater_example_decoded as $item ){
								echo '<li><span class="title">'. $item->title .'</span><span class="price">'. $item->subtitle .'</span></li>';
							}
							echo '</ul></div>';
						}
						if(!empty( $img_pricing )){
							echo '<div class="col-right">';
							echo '<img src="'. $img_pricing .'" alt="price" >';
							echo '</div>';
						}
					?>
					</div>
				</div>
			</div>
		<?php
		}
	}
}
/*----Got a contact... section in Homepage----*/
if(!function_exists('beer_pub_get_home_contact')){
    function beer_pub_get_home_contact() {
		if(get_theme_mod('contact_show','yes')== 'yes'){
			$contact_shortcode = get_theme_mod('contact_shortcode');
			$contact_title = get_theme_mod('contact_title','Have a Project in Mind?');
			$contact_sub_title = get_theme_mod('contact_sub_title','lets make something awesome');
			$contact_desc = get_theme_mod("contact_desc","Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been 1500s, scrambled it to make specimen book.");
			
			$contact_address = get_theme_mod('contact_address','204, Eastwood, America');
			$contact_opening = get_theme_mod('contact_opening','10:00 am - 11:00 pm');
			$contact_call = get_theme_mod('contact_call','800 1234 5678');
			?>
			<div class="block block-contact">
                <div class="container">
                    <div class="row">
						<div class="left-contact col-lg-5 col-md-5 col-sm-12 col-xs-12">
							<?php  if($contact_title !=''){ ?>
								<h2><?php echo $contact_title; ?></h2>
							<?php } ?>
							<?php  if($contact_sub_title !=''){ ?>
								<p class="sub-title"><?php echo $contact_sub_title; ?></p>
							<?php } ?>
							<?php  if($contact_desc !=''){ ?>
								<?php echo apply_filters( 'the_content', $contact_desc); ?>
							<?php } ?>
							<div class="info-address">
								<?php  if($contact_address !=''){ ?>
									<p class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $contact_address; ?></p>
								<?php } ?>	
								<?php  if($contact_opening !=''){ ?>
									<p class="opening"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo $contact_opening; ?></p>
								<?php } ?>
								<?php  if($contact_call !=''){ ?>
									<p class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:<?php echo str_replace(" ","", $contact_call); ?>"><?php echo $contact_call; ?></a></p>
								<?php } ?>								
							</div>
						</div>
						<div class="right-conatct col-lg-7 col-md-7 col-sm-12 col-xs-12">
							<?php  if($contact_shortcode !=''){ echo do_shortcode(''.$contact_shortcode.''); } ?>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
	}
}

/*-----Contact sectuon*/
if(!function_exists('beer_pub_contact_section')){
    function beer_pub_contact_section() {
        if(get_theme_mod('contact_show','yes')== 'yes'):
            $map_info_apikey = get_theme_mod('map_info_apikey','AIzaSyC3AJXtEuS4jES0qzehaba39veYfgNS8fg');
            $map_long = get_theme_mod('map_info_long','-74.0059731');
            $map_lat = get_theme_mod('map_info_lat','40.7143528');
            $map_zoom = get_theme_mod('map_zoom','13');
            $map_location_icon = get_theme_mod('map_location_icon','300');
            $contact_shortcode = get_theme_mod('contact_shortcode','[contact-form-7 id="49" title="Contact form home"]');
        ?>
            <div class="contact-section-wrapper">
            <?php
                if($map_long != '' && $map_lat !=''):
                    $class="has-maps" ; 
					if(empty($map_location_icon)){
						$map_location_icon = 300;
					}else{
						$map_location_icon = get_theme_mod('map_location_icon','300');
					}
                ?>
                     <div class="wrap">
						<div class="container">
                        <?php if($contact_shortcode != ''): ?>
                                <?php echo do_shortcode($contact_shortcode); ?>
                        <?php endif; ?>
						</div>
                    </div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $map_info_apikey; ?>&sensor=false"></script>
                    <script>
					function initMap() {					
						google.maps.Map.prototype.setCenterWithOffset= function(latlng, offsetX, offsetY) {
							var map = this;
							var ov = new google.maps.OverlayView(); 
							ov.onAdd = function() { 
								var proj = this.getProjection(); 
								var aPoint = proj.fromLatLngToContainerPixel(latlng);
								aPoint.x = aPoint.x+offsetX;
								aPoint.y = aPoint.y+offsetY;
								map.setCenter(proj.fromContainerPixelToLatLng(aPoint));
							}
							ov.draw = function() {}; 
							ov.setMap(this); 
						};
						   
						var latlng = new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_long; ?>);
						var map = new google.maps.Map(document.getElementById("map_canvas"), {
							zoom: <?php echo $map_zoom; ?>,
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							center: latlng,
							disableDefaultUI: true
						});

						map.setCenterWithOffset(latlng, <?php echo $map_location_icon; ?>, 0);
						var image = '';
						var beachMarker = new google.maps.Marker({
							position: latlng,
							map: map,
							icon: {
								url: "<?php echo get_template_directory_uri() . '/images/icon-map.png'?>",
							}
						});
						}
						google.maps.event.addDomListener(window, 'load', initMap);
                    </script>
                    <div id="map_canvas"></div>
                <?php 
                endif;?>
               
            </div>
    <?php   endif;
    }
}

/*-----function render header menu*/
if(!function_exists('render_header_menu')){
    function render_header_menu() { ?>
        <nav id="site-navigation" class="main-navigation">
            <div class="close-menu-mobile d-xl-none">
                <i></i>
            </div>
            <?php
            $before_items_wrap = '';
            $after_item_wrap = '';
            if (has_nav_menu('primary')) {
                wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'mega-menu',
                        'items_wrap' => $before_items_wrap . '<ul id="%1$s" class="%2$s">%3$s</ul>' . $after_item_wrap,
                        'walker' => new Walker_Nav_Menu()
                    )
                );
            }
            ?>
        </nav>
    <?php
    }
}
?>