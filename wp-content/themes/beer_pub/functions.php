<?php
$theme = wp_get_theme();
define('beer_pub_VERSION', $theme->get('Version'));
define('beer_pub_LIB', get_template_directory() . '/inc');
define('beer_pub_ADMIN', beer_pub_LIB . '/admin');
define('beer_pub_PLUGINS', beer_pub_LIB . '/plugins');
define('beer_pub_FUNCTIONS', beer_pub_LIB . '/functions');
define('beer_pub_CSS', get_template_directory_uri() . '/css');
define('beer_pub_JS', get_template_directory_uri() . '/js');
require_once(beer_pub_FUNCTIONS . '/post-type.php');
require_once(beer_pub_ADMIN . '/functions.php');
require_once(beer_pub_FUNCTIONS . '/functions.php');
require_once(beer_pub_PLUGINS . '/functions.php');
require_once(beer_pub_LIB. '/customizer.php');
// Set up the content width value based on the theme's design and stylesheet.
if (!isset($content_width)) {
    $content_width = 1140;
}
if (!function_exists('beer_pub_setup')) {
    /**
     *
     * beer_pub default setup
     * Registers support for various WordPress features.
     *
     * @since beer_pub 1.0
     */
    function beer_pub_setup() {
        /*
         * Make beer_pub available for translation.
         *
         * Translations can be added to the /languages/ directory.
         */
        load_theme_textdomain('beer_pub', get_template_directory() . '/languages');

        // Add theme style editor support
        add_editor_style( array( 'style.css' ) );

        add_theme_support( 'title-tag' );

        // Add RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');

        // register menu location
        register_nav_menus( array(
            'primary' => esc_html__('Primary Menu', 'beer_pub'),
            'footer' => esc_html__('Footer Menu', 'beer_pub'),
        ));
        
        add_theme_support( 'custom-header' );

        // This theme allows users to set a custom background.
        add_theme_support( 'custom-background' );
        
        add_theme_support( 'post-formats', array(
                'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
        ) );
        // Enable support for Post Thumbnails, and declare two sizes.
        add_theme_support( 'post-thumbnails' );
        add_image_size('galley-img-2', 846,451, false);
        add_image_size('galley-img-3', 450,358, false);
        add_image_size('galley-img-4', 180,179, true);
    }
}
add_action('after_setup_theme', 'beer_pub_setup');

/**
 *
 * Enqueue style file for backend
 *
 * @since beer_pub 1.0
 */
add_action('admin_enqueue_scripts', 'beer_pub_ADMIN_scripts_css');
function beer_pub_ADMIN_scripts_css() {
    wp_enqueue_style('beer_pub_ADMIN_css', get_template_directory_uri() . '/inc/admin/css/admin.css', false);
    wp_enqueue_style('beer_pub_select_css', get_template_directory_uri() . '/inc/admin/css/select2.min.css', false);
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css?ver=' . beer_pub_VERSION);
	wp_enqueue_script('select-js', get_template_directory_uri() . '/inc/admin/js/select2.min.js', array('jquery'), beer_pub_VERSION, true);
}

/**
 *
 * Setup default google font for Mavikmover
 *
 * @since Mavikmover 1.0
 */
function beer_pub_fonts_url() {
    $font_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    
    $body_font = esc_html(get_theme_mod('google_font','Arial:100,200,300,400'));
    $google_font_header = esc_html(get_theme_mod('google_font_header','Life Savers:400,700'));
    $google_font_menu = esc_html(get_theme_mod('google_font_menu','Staatliches:400'));
	$google_font_h = get_theme_mod( 'google_font_h','Lily Script One:400,700' );
	$google_font_p = get_theme_mod( 'google_font_p','Libre Baskerville:400,400i,700' );
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'beer_pub' ) ) {
		if(!empty($body_font) || !empty($google_font_h)){
		    if($body_font){
                $fonts[] = $body_font;
            }
            if($google_font_h){
                $fonts[] = $google_font_h;
            }
            if($google_font_header){
                $fonts[] = $google_font_header;
            }
            if($google_font_p){
                $fonts[] = $google_font_p;
            }
            if($google_font_menu){
                $fonts[] = $google_font_menu;
            }
            $fonts[] = 'Montserrat'.':100,100i,200i,300,400,500,500i,600,600i,700,700i,800,800i,900,900i';
		}else{
            $fonts[] = 'Montserrat'.':100,100i,200i,300,400,500,500i,600,600i,700,700i,800,800i,900,900i';
        }
    }
    /*
     * Translators: To add an additional character subset specific to your language,
     * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
     */
    $subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'modern' );

    if ( 'cyrillic' == $subset ) {
        $subsets .= ',cyrillic,cyrillic-ext';
    } elseif ( 'greek' == $subset ) {
        $subsets .= ',greek,greek-ext';
    } elseif ( 'devanagari' == $subset ) {
        $subsets .= ',devanagari';
    } elseif ( 'vietnamese' == $subset ) {
        $subsets .= ',vietnamese';
    }

    if ( $fonts ) {
        $font_url = add_query_arg( array(
            'family' => urlencode(implode( '|', $fonts )),
            'subset' => urlencode( $subsets ),
        ), '//fonts.googleapis.com/css' );
    }

    return $font_url;
}

/**
 * Output CSS in document head.
 */
function beer_pub_google_fonts_css() {
	$font_size 	= get_theme_mod( 'font_size', '18' ); 
	$font_size 	= $font_size . 'px';
	if(!empty( get_theme_mod( 'google_font','Arial,Helvetica Neue,Helvetica,sans-serif:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' ) )){
		$body_fonts = get_theme_mod( 'google_font',' Arial,Helvetica Neue,Helvetica,sans-serif:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' );
		$body_font = explode(":", $body_fonts);
	}else{
        $body_fonts = 'Arial, Helvetica, sans-serif';
        $body_font = explode(":", $body_fonts);
    }
	if(!empty( get_theme_mod( 'google_font_h','Lily Script One:400,700' ) )){
		$google_font_hs = get_theme_mod( 'google_font_h','Lily Script One:400,700' );
		$google_font_h = explode(":", $google_font_hs);
	}
	if(!empty( get_theme_mod( '$google_font_header','Life Savers:400,700' ) )){
        $google_font_headers = get_theme_mod( '$google_font_header','Life Savers:400,700' );
        $google_font_header = explode(":", $google_font_headers);
	}
	if(!empty( get_theme_mod( '$google_font_p','Libre Baskerville:400,400i,700' ) )){
        $google_font_ps = get_theme_mod( '$google_font_p','Libre Baskerville:400,400i,700' );
        $google_font_p = explode(":", $google_font_ps);
	}
	if(!empty( get_theme_mod( '$google_font_menu','Staatliches:400' ) )){
        $google_font_menus = get_theme_mod( '$google_font_menu','Staatliches:400' );
        $google_font_menu = explode(":", $google_font_menus);
	}
?>
	<style type='text/css' media='all'>
		body{
			font-family: <?php esc_html_e( $google_font_h[0] ); ?>;
			font-size: <?php esc_html_e( $font_size ); ?>;
		}
		.h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6{
			font-family: "<?php esc_html_e( $google_font_h[0] ); ?>";
			font-weight: 500;
		}
        .header .wrap-header-info p{
            font-family: "<?php esc_html_e( $google_font_header[0] ); ?>";
            font-weight: bold;
        }
        .p, p,.menu-lists a{
            font-family: "<?php esc_html_e( $google_font_p[0] ); ?>";
            font-weight: 400;
        }
        .menu-main,.mega-menu,.inner-au a,.inner-contact a,.inner-contact p{
            font-family: "<?php esc_html_e( $google_font_menu[0] ); ?>";
            font-weight: 400;
        }
        .copyright{
            font-family: "<?php esc_html_e( $body_font[0] ); ?>";
            font-weight: 400;
        }

	</style>
<?php 
}
add_action( 'wp_head', 'beer_pub_google_fonts_css' );

/**
 *
 * Enqueue script & styles
 * Registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support post thumbnails.
 *
 * @since beer_pub 1.0
 */

function beer_pub_scripts_js() {

    global $beer_pub_settings, $wp_query, $wp_styles;
    $beer_pubs_valid_form = '';
    // comment reply
    if ( is_singular() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    $beer_pubs_suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

    /** Enqueue Google Fonts */
    wp_enqueue_style( 'beer_pub-fonts', beer_pub_fonts_url(), array(), null );


   wp_enqueue_style('font-awesome',get_template_directory_uri() .'/css/fontawesome-all.min.css?ver=' . beer_pub_VERSION);
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/plugin/bootstrap.min.css?ver=' . beer_pub_VERSION);
    wp_enqueue_style('beer_pub-theme', get_template_directory_uri() . '/css/theme'.$beer_pubs_suffix.'.css?ver=' . beer_pub_VERSION);
    wp_deregister_style( 'beer_pub-style' );
    wp_register_style( 'beer_pub-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style('css-slick',get_template_directory_uri() .'/css/slick.min.css?ver=' . beer_pub_VERSION);
    wp_enqueue_style( 'beer_pub-style' );


    // Enqueue script 

    if( post_type_supports( get_post_type(), 'comments' ) ) {
        if( comments_open() ) {
            $charitys_valid_form = 'yes';
            wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), beer_pub_VERSION);
        }
    }

    wp_enqueue_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), beer_pub_VERSION, true);
    wp_enqueue_script('beer_pub-script', get_template_directory_uri() . '/js/un-minify/theme.min.js', array('jquery'), beer_pub_VERSION, true);

    wp_localize_script('beer_pub-script', 'beer_pub_params', array(
        'ajax_url' => esc_js(admin_url( 'admin-ajax.php' )),
        'ajax_loader_url' => esc_js(str_replace(array('http:', 'https'), array('', ''), beer_pub_CSS . '/images/ajax-loader.gif')),
        'beer_pub_valid_form' => esc_js($beer_pubs_valid_form),
        'beer_pub_search_no_result' => esc_js(__('Search no result','beer_pub')),
        'beer_pub_like_text' => esc_js(__('Like','beer_pub')),
        'beer_pub_unlike_text' => esc_js(__('Unlike','beer_pub')),
        'request_error' => esc_js(__('The requested content cannot be loaded.<br/>Please try again later.', 'beer_pub')),
    ));
}
add_action('wp_enqueue_scripts', 'beer_pub_scripts_js');

// fix validator.w3.org attribute css and js

add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
function codeless_remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
function pietergoosen_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'pietergoosen' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'pietergoosen' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <footer class="comment-meta">
                    <div class="comment-author vcard">
                        <?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                    </div><!-- .comment-author -->

                    <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pietergoosen' ); ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->

                <div class="comment-content">
					<?php printf( __( '%s' ), sprintf( '<h4 class="name">%s</h4>', get_comment_author_link() ) ); ?>
                    <?php comment_text(); ?>
					<ul class="social-author social-share">
						<?php 
							$comment = get_comment( );
							$comment_author_id = $comment -> user_id; 
						?>
						<?php if(get_user_meta( $comment_author_id, 'twitter', true )){ ?>
							<li><a class="tw" target="_blank" href="<?php echo get_user_meta( $comment_author_id, 'twitter', true ); ?>"><i class="fab fa-twitter-square"></i></a></li>
						<?php } ?>
						<?php if(get_user_meta( $comment_author_id, 'facebook', true )){ ?>
							<li><a class="fb" target="_blank" href="<?php echo get_user_meta( $comment_author_id, 'facebook', true ); ?>"><i class="fab fa-facebook-square"></i></a></li>
						<?php } ?>
						<?php if(get_user_meta( $comment_author_id, 'instagram', true )){ ?>
							<li><a class="inta" target="_blank" href="<?php echo get_user_meta( $comment_author_id, 'instagram', true ); ?>"><i class="fab fa-instagram"></i></a></li>
						<?php } ?>
						<?php if(get_user_meta( $comment_author_id, 'google', true )){ ?>
							<li><a class="gg" target="_blank" href="<?php echo get_user_meta( $comment_author_id, 'google', true ); ?>"><i class="fab fa-google-plus"></i></a></li>
						<?php } ?>
						<?php if(get_user_meta( $comment_author_id, 'linkedin', true )){ ?>
							<li><a class="linkedin" target="_blank" href="<?php echo get_user_meta( $comment_author_id, 'linkedin', true ); ?>"><i class="fab fa-linkedin"></i></a></li>
						<?php } ?>
					</ul>
                </div><!-- .comment-content -->

                <div class="reply">
                    <?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </article><!-- .comment-body -->
    <?php
        break;
    endswitch; 
}

add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
    <h3><?php _e("Extra profile information", "blank"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="facebook"><?php _e("Facebook"); ?></label></th>
        <td>
            <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter link."); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="twitter"><?php _e("Twitter"); ?></label></th>
        <td>
            <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter link."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="instagram"><?php _e("Instagram"); ?></label></th>
        <td>
            <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter link."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="google"><?php _e("Google"); ?></label></th>
        <td>
            <input type="text" name="google" id="google" value="<?php echo esc_attr( get_the_author_meta( 'google', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter link."); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="linkedin"><?php _e("Linkedin"); ?></label></th>
        <td>
            <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php _e("Please enter link."); ?></span>
        </td>
    </tr>
    </table>
<?php }
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );

function save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
    update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
    update_user_meta( $user_id, 'google', $_POST['google'] );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
}


/**
 * Register "Testimonials" post type
 * @return [type] [description]
 */
function register_testimonial_post_type() {

    $labels = array(
        'name' => __('Testimonials', 'barbershop-core'),
        'singular_name' => __('Testimonials', 'barbershop-core'),
        'add_new' => __('Add New', 'barbershop-core'),
        'add_new_item' => __('Add New Testimonial', 'barbershop-core'),
        'edit_item' => __('Edit Testimonial', 'barbershop-core'),
        'new_item' => __('New Testimonial', 'barbershop-core'),
        'all_items' => __('All Testimonial', 'barbershop-core'),
        'view_item' => __('View Testimonial', 'barbershop-core'),
        'search_items' => __('Search Testimonials', 'barbershop-core'),
        'not_found' =>  __('No Testimonials found', 'barbershop-core'),
        'not_found_in_trash' => __('No Testimonials found in Trash', 'barbershop-core'),
        'parent_item_colon' => '',
        'menu_name' => __('Testimonials', 'barbershop-core')
    );

    $args = array(
        'labels' => $labels,
        'public' => false,
        'exclude_from_search' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array( 'slug' => 'testimonial' ),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 50,
        'menu_icon' => 'dashicons-groups',
        'supports' => array( 'title','editor', 'thumbnail', 'revisions','page-attributes')
    );

    register_post_type( 'testimonial', $args);

}
add_action( 'init', 'register_testimonial_post_type');

/**
 * Customize Rug table overview tables
 */

function add_new_testimonial_table_columns($gallery_columns) {
    $new_columns['cb'] = '<input type="checkbox" />';
    $new_columns['image'] = __('Image', 'barbershop-core');
    $new_columns['title'] = _x('Name', 'column name', 'barbershop-core');
    $new_columns['date'] = _x('Date', 'column name', 'barbershop-core');

    return $new_columns;
}
// Add to admin_init function
add_filter('manage_testimonial_posts_columns', 'add_new_testimonial_table_columns');
function manage_testimonial_table_columns($column_name, $id) {
    global $wpdb;
    $featured_img_url = get_the_post_thumbnail_url($id, 'thumbnail');
    switch ($column_name) {
        case 'image':
            if(!empty($featured_img_url)){
                echo '<img src="'. $featured_img_url .'" width="80" >';
            }else{
                echo 'No image';
            }
            break;
        default:
            break;
    } // end switch
}
// Add to admin_init function
add_action('manage_testimonial_posts_custom_column', 'manage_testimonial_table_columns', 10,2);

/**
 * Register meta box testimonial
 */
function testimonial_meta_box(){
    add_meta_box(
        'meta-box-testimonial', 'Testimonial info', 'testimonial_meta_display', 'testimonial', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'testimonial_meta_box' );
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */

function testimonial_meta_display(){
    global $post ;
    $testimonial_name = get_post_meta( $post->ID, 'testimonial_name', true );
    $testimonial_position = get_post_meta( $post->ID, 'testimonial_position', true );
    wp_nonce_field( 'save_testimonial', 'testimonial_nonce' );
    ?>
    <div class="testimonial-info-wrapper">
        <div class="single-field-wrap">
            <h4><span class="section-title"><?php _e( 'Position', 'barbershop-core' );?></span></h4>
            <span class="section-inputfield"><input style="width:100%;" type="text" name="testimonial_position" value="<?php if( !empty( $testimonial_position ) ){ echo $testimonial_position ; }?>" /></span>
        </div>
    </div>
    <?php
}
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function testimonial_save_meta_box(
    $post_id ) {

    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['testimonial_nonce'] ) || !wp_verify_nonce( $_POST['testimonial_nonce'], 'save_testimonial' ) ) return;

    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;

    if( isset( $_POST['testimonial_position'] ) ){
        update_post_meta( $post_id, 'testimonial_position',  $_POST['testimonial_position'] );
    }else{
        delete_post_meta( $post_id, 'testimonial_position' );
    }
}
add_action( 'save_post', 'testimonial_save_meta_box' );


function exclude_category_posts( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$The_pub_category = get_theme_mod('The_pub_category');
		$our_brewery_category = get_theme_mod('our_brewery_category');
		
		$query->set( 'cat', "-$The_pub_category,-$our_brewery_category" );
	}
}
add_action( 'pre_get_posts', 'exclude_category_posts' );