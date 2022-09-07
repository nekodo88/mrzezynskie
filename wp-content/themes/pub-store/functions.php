<?php         
/**
 * Pub Store functions and definitions
 *
 * @package Pub Store
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */

if ( ! function_exists( 'pub_store_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.  
 */
function pub_store_setup() {		
	$GLOBALS['content_width'] = apply_filters( 'pub_store_content_width', 680 );	
	load_theme_textdomain( 'pub-store', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );	
	add_theme_support('html5');
	add_theme_support( 'post-thumbnails' );	
	add_theme_support( 'title-tag' );	
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );	
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 150,
		'flex-height' => true,
	) );	
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'pub-store' ),						
	) );
	add_editor_style( 'editor-style.css' );
} 
endif; // pub_store_setup
add_action( 'after_setup_theme', 'pub_store_setup' );
function pub_store_widgets_init() { 	
	
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'pub-store' ),
		'description'   => __( 'Appears on blog page sidebar', 'pub-store' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 1', 'pub-store' ),
		'description'   => __( 'Appears on footer', 'pub-store' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 2', 'pub-store' ),
		'description'   => __( 'Appears on footer', 'pub-store' ),
		'id'            => 'footer-2',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 3', 'pub-store' ),
		'description'   => __( 'Appears on footer', 'pub-store' ),
		'id'            => 'footer-3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Footer Widget 4', 'pub-store' ),
		'description'   => __( 'Appears on footer', 'pub-store' ),
		'id'            => 'footer-4',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5>',
		'after_title'   => '</h5>',
	) );	
	
}
add_action( 'widgets_init', 'pub_store_widgets_init' );


function pub_store_font_url(){
		$font_url = '';	
		
		
		/* Translators: If there are any character that are not
		* supported by Assistant, trsnalate this to off, do not
		* translate into your own language.
		*/
		$assistant = _x('on','Assistant:on or off','pub-store');
		
		/* Translators: If there are any character that are not
		* supported by Great Vibes, trsnalate this to off, do not
		* translate into your own language.
		*/
		$greatvibes = _x('on','Great Vibes:on or off','pub-store');		
		
		/* Translators: If there are any character that are not
		* supported by Roboto, trsnalate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on','Roboto:on or off','pub-store');	
		
		    if('off' !== $roboto || 'off' !== $greatvibes || 'off' !== $assistant ){
			    $font_family = array();
			
			if('off' !== $assistant){
				$font_family[] = 'Assistant:300,400,600';
			}
			
			if('off' !== $greatvibes){
				$font_family[] = 'Great Vibes:400';
			}
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,900';
			}		
						
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function pub_store_scripts() {
	wp_enqueue_style('pub-store-font', pub_store_font_url(), array());
	wp_enqueue_style( 'pub-store-basic-style', get_stylesheet_uri() );	
	wp_enqueue_style( 'nivo-slider', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'fontawesome-all-style', get_template_directory_uri().'/fontsawesome/css/fontawesome-all.css' );
	wp_enqueue_style( 'pub-store-responsive', get_template_directory_uri()."/css/responsive.css" );
	wp_enqueue_script( 'jquery-nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'pub-store-editable', get_template_directory_uri() . '/js/editable.js' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pub_store_scripts' );

function pub_store_ie_stylesheet(){
	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style('pub-store-ie', get_template_directory_uri().'/css/ie.css', array( 'pub-store-style' ), '20160928' );
	wp_style_add_data('pub-store-ie','conditional','lt IE 10');
	
	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'pub-store-ie8', get_template_directory_uri() . '/css/ie8.css', array( 'pub-store-style' ), '20160928' );
	wp_style_add_data( 'pub-store-ie8', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'pub-store-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'pub-store-style' ), '20160928' );
	wp_style_add_data( 'pub-store-ie7', 'conditional', 'lt IE 8' );	
	}
add_action('wp_enqueue_scripts','pub_store_ie_stylesheet');

define('PUB_STORE_THEME_DOC','https://www.gracethemes.com/documentation/pubstore-doc/#homepage-lite','pub-store');
define('PUB_STORE_PROTHEME_URL','https://gracethemes.com/themes/winery-wordpress-theme/','pub-store');
define('PUB_STORE_LIVE_DEMO','https://www.gracethemes.com/demo/pubstore/','pub-store');

//Custom Excerpt length.
function pub_store_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'pub_store_excerpt_length', 999 );


//Logo Options
if ( ! function_exists( 'pub_store_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function pub_store_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

/**
 * Customize Pro included.
 */
require_once get_template_directory() . '/customize-pro/class-customize.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template for about theme.
 */
if ( is_admin() ) { 
require get_template_directory() . '/inc/about-themes.php';
}

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * WooCommerce Compatibility
 */
add_action( 'after_setup_theme', 'pub_store_setup_woocommerce_support' );
function pub_store_setup_woocommerce_support()   
{
  	add_theme_support('woocommerce');
	add_theme_support( 'wc-product-gallery-zoom' ); 
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' ); 
}


/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function pub_store_skip_link_focus_fix() {  
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php                 
}
add_action( 'wp_print_footer_scripts', 'pub_store_skip_link_focus_fix' );