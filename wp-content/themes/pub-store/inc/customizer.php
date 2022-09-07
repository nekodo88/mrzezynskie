<?php    
/**
 *Pub Store Theme Customizer
 *
 * @package Pub Store
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pub_store_customize_register( $wp_customize ) {	
	
	function pub_store_sanitize_dropdown_pages( $page_id, $setting ) {
	  // Ensure $input is an absolute integer.
	  $page_id = absint( $page_id );
	
	  // If $page_id is an ID of a published page, return it; otherwise, return the default.
	  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
	}

	function pub_store_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}  
		
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	 //Panel for section & control
	$wp_customize->add_panel( 'pub_store_panel_area', array(
		'priority' => null,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Theme Options Panel', 'pub-store' ),		
	) );
	
	//Site Layout Options
	$wp_customize->add_section('pub_store_layout_type',array(
		'title' => __('Site Layout Option','pub-store'),			
		'priority' => 1,
		'panel' => 	'pub_store_panel_area',          
	));		
	
	$wp_customize->add_setting('pub_store_boxlayout_option',array(
		'sanitize_callback' => 'pub_store_sanitize_checkbox',
	));	 

	$wp_customize->add_control( 'pub_store_boxlayout_option', array(
    	'section'   => 'pub_store_layout_type',    	 
		'label' => __('Check to Box Layout','pub-store'),
		'description' => __('If you want to box layout please check the Box Layout Option.','pub-store'),
    	'type'      => 'checkbox'
     )); // Site Layout Section 
	
	$wp_customize->add_setting('pub_store_color_scheme',array(
		'default' => '#dd3333',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'pub_store_color_scheme',array(
			'label' => __('Color Scheme','pub-store'),			
			'description' => __('More color options in available PRO Version','pub-store'),
			'section' => 'colors',
			'settings' => 'pub_store_color_scheme'
		))
	);	
	
	// Slider Section		
	$wp_customize->add_section( 'pub_store_homeslideoptions', array(
		'title' => __('Slider Options', 'pub-store'),
		'priority' => null,
		'description' => __('Default image size for slider is 1400 x 650 pixel.','pub-store'), 
		'panel' => 	'pub_store_panel_area',           			
    ));
	
	$wp_customize->add_setting('pub_store_homeslide1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'pub_store_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('pub_store_homeslide1',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide one:','pub-store'),
		'section' => 'pub_store_homeslideoptions'
	));	
	
	$wp_customize->add_setting('pub_store_homeslide2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'pub_store_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('pub_store_homeslide2',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide two:','pub-store'),
		'section' => 'pub_store_homeslideoptions'
	));	
	
	$wp_customize->add_setting('pub_store_homeslide3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'pub_store_sanitize_dropdown_pages'
	));
	
	$wp_customize->add_control('pub_store_homeslide3',array(
		'type' => 'dropdown-pages',
		'label' => __('Select page for slide three:','pub-store'),
		'section' => 'pub_store_homeslideoptions'
	));	// Slider Section	
	
	$wp_customize->add_setting('pub_store_homeslidemore',array(
		'default' => null,
		'sanitize_callback' => 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('pub_store_homeslidemore',array(	
		'type' => 'text',
		'label' => __('Add slider Read more button name here','pub-store'),
		'section' => 'pub_store_homeslideoptions',
		'setting' => 'pub_store_homeslidemore'
	)); // Slider Read More Button Text
	
	$wp_customize->add_setting('pub_store_homeslideshowoption',array(
		'default' => false,
		'sanitize_callback' => 'pub_store_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'pub_store_homeslideshowoption', array(
	    'settings' => 'pub_store_homeslideshowoption',
	    'section'   => 'pub_store_homeslideoptions',
	     'label'     => __('Check To Show This Section','pub-store'),
	   'type'      => 'checkbox'
	 ));//Show Slider Section	
	 
	 
	// Our Features section
	$wp_customize->add_section('pub_store_ourftr_section', array(
		'title' => __('Top Services Column Section','pub-store'),
		'description' => __('Select pages from the dropdown for services section','pub-store'),
		'priority' => null,
		'panel' => 	'pub_store_panel_area',          
	));	
	
	$wp_customize->add_setting('pub_store_ourftrpage1',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'pub_store_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'pub_store_ourftrpage1',array(
		'type' => 'dropdown-pages',			
		'section' => 'pub_store_ourftr_section',
	));		
	
	$wp_customize->add_setting('pub_store_ourftrpage2',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'pub_store_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'pub_store_ourftrpage2',array(
		'type' => 'dropdown-pages',			
		'section' => 'pub_store_ourftr_section',
	));
	
	$wp_customize->add_setting('pub_store_ourftrpage3',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'pub_store_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'pub_store_ourftrpage3',array(
		'type' => 'dropdown-pages',			
		'section' => 'pub_store_ourftr_section',
	));
	
	
	$wp_customize->add_setting('pub_store_ourftr_showpanel',array(
		'default' => false,
		'sanitize_callback' => 'pub_store_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'pub_store_ourftr_showpanel', array(
	   'settings' => 'pub_store_ourftr_showpanel',
	   'section'   => 'pub_store_ourftr_section',
	   'label'     => __('Check To Show This Section','pub-store'),
	   'type'      => 'checkbox'
	 ));//Show services section
	 
	 // Welcome section 
	$wp_customize->add_section('pub_store_welcome_section', array(
		'title' => __('Welcome Section','pub-store'),
		'description' => __('Select Pages from the dropdown for welcome section','pub-store'),
		'priority' => null,
		'panel' => 	'pub_store_panel_area',          
	));		
	
	$wp_customize->add_setting('pub_store_welcomepage',array(
		'default' => '0',			
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'pub_store_sanitize_dropdown_pages'
	));
 
	$wp_customize->add_control(	'pub_store_welcomepage',array(
		'type' => 'dropdown-pages',			
		'section' => 'pub_store_welcome_section',
	));		
	
	$wp_customize->add_setting('show_pub_store_welcomepage',array(
		'default' => false,
		'sanitize_callback' => 'pub_store_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 
	
	$wp_customize->add_control( 'show_pub_store_welcomepage', array(
	    'settings' => 'show_pub_store_welcomepage',
	    'section'   => 'pub_store_welcome_section',
	    'label'     => __('Check To Show This Section','pub-store'),
	    'type'      => 'checkbox'
	));//Show Welcome Section
	 
	
		 
}
add_action( 'customize_register', 'pub_store_customize_register' );

function pub_store_custom_css(){ 
?>
	<style type="text/css"> 					
        a, .postlist_style h2 a:hover,
        #sidebar ul li a:hover,								
        .postlist_style h3 a:hover,	
		.logo h1 span,				
        .recent-post h6:hover,	
		.social-icons a:hover,				
        .ps_3colbx:hover .button,									
        .postmeta a:hover,
        .button:hover,		
        .footercolumn ul li a:hover, 
        .footercolumn ul li.current_page_item a,      
        .ps_3colbx:hover h3 a,		
        .header-contactpart a:hover,
		.sitefooter h2 span,
		.sitefooter ul li a:hover, 
		.sitefooter ul li.current_page_item a,
        .mainmenu ul li a:hover, 
        .mainmenu ul li.current-menu-item a,
        .mainmenu ul li.current-menu-parent a.parent,
        .mainmenu ul li.current-menu-item ul.sub-menu li a:hover				
            { color:<?php echo esc_html( get_theme_mod('pub_store_color_scheme','#dd3333')); ?>;}					 
            
        .pagination ul li .current, .pagination ul li a:hover, 
        #commentform input#submit:hover,					
        .nivo-controlNav a.active,
        .learnmore:hover,
		.ps_3colbx:hover .learnmore,	
		.ps_3colbx .ps_thumbbx,	
		.nivo-caption .slide_more,											
        #sidebar .search-form input.search-submit,				
        .wpcf7 input[type='submit'],				
        nav.pagination .page-numbers.current,       		
        .toggle a	
            { background-color:<?php echo esc_html( get_theme_mod('pub_store_color_scheme','#dd3333')); ?>;}	
			
		.ps_3colbx:hover .ps_thumbbx	
            { border-color:<?php echo esc_html( get_theme_mod('pub_store_color_scheme','#dd3333')); ?>;}
			
		#sitelayout_type a:focus,
		button:focus,
		input[type="button"]:focus,		
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="reset"]:focus,
		input[type="submit"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,		
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus		
            { outline:thin solid <?php echo esc_html( get_theme_mod('pub_store_color_scheme','#dd3333')); ?>;}				
									
			
						
         	
    </style> 
<?php                                           
}
         
add_action('wp_head','pub_store_custom_css');	 

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pub_store_customize_preview_js() {
	wp_enqueue_script( 'pub_store_customizer', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20171016', true );
}
add_action( 'customize_preview_init', 'pub_store_customize_preview_js' );