<?php

/**
 * Implement Customizer additions and adjustments.
 *
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
add_action( 'customize_register', 'beer_pub_customize_register' );
function beer_pub_customize_register( $wp_customize ) {

	remove_theme_support('custom-header');
	
	require_once( get_template_directory().'/inc/class/customizer-repeater-control.php' );

	if ( ! class_exists( 'beer_pub_Customize_Sidebar_Control' ) ) {
	    class beer_pub_Customize_Sidebar_Control extends WP_Customize_Control {
	        /**
	         * Render the control's content.
	         *
	         * @since 3.4.0
	         */
	        public function render_content() {

				$output = '
			        <select>';
						foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
						     $output .= '<option value="'.esc_attr( $sidebar['id'] ).'"'.'>'.
						              ucwords( $sidebar['name']).'</option>';
						}
					$output .= '</select>';

					$output = str_replace( '<select', '<select ' . $this->get_link(), $output );

					printf(
					    '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
					    $this->label,
					    $output
					);
					?>
					<?php if ( '' != $this->description ) : ?>
						<div class="description customize-control-description">
							<?php echo esc_html( $this->description ); ?>
						</div>
					<?php endif; 
	        }
	    }
	}
    if ( ! class_exists( 'My_Dropdown_Category_Control' ) ) {
        class My_Dropdown_Category_Control extends WP_Customize_Control {

            public $type = 'dropdown-category';

            public $dropdown_args = false;

            public function render_content() {
                $dropdown_args = wp_parse_args( $this->dropdown_args, array(
                    'taxonomy'          => 'category',
                    'show_option_none'  => ' ',
                    'selected'          => $this->value(),
                    'show_option_all'   => '',
                    'orderby'           => 'id',
                    'order'             => 'ASC',
                    'show_count'        => 1,
                    'hide_empty'        => 1,
                    'child_of'          => 0,
                    'exclude'           => '',
                    'hierarchical'      => 1,
                    'depth'             => 0,
                    'tab_index'         => 0,
                    'hide_if_empty'     => false,
                    'option_none_value' => 0,
                    'value_field'       => 'term_id',
                ) );

                $dropdown_args['echo'] = false;

                $dropdown = wp_dropdown_categories( $dropdown_args );
                $dropdown1 = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
                $dropdown1 = str_replace( 'cat', '', $dropdown1);
                printf('<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
					    $this->label, $dropdown1);
            }
        }
    }
	
	if ( ! class_exists( 'WP_Customize_Control' ) )
		return NULL;
	/**
	 * Class to create a custom post type control
	 */
	class Post_Type_Dropdown_Custom_Control extends WP_Customize_Control
	{
		private $posts = false;
		public function __construct($manager, $id, $args = array(), $options = array())
		{
			$postargs = array(
				'post_type' => 'service',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby'	=> 'date',
				'order'	=> 'DESC',
			);
			$this->posts = get_posts($postargs);
			parent::__construct( $manager, $id, $args );
		}
		/**
		* Render the content on the theme customizer page
		*/
		public function render_content()
		{
			if(!empty($this->posts))
			{
				?>
					<label>
						<span class="customize-service-dropdown"><?php echo esc_html( $this->label ); ?></span>
						<select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
						<?php
							foreach ( $this->posts as $post )
							{
								printf('<option value="%s" %s>%s</option>', $post->ID, selected($this->value(), $post->ID, false), $post->post_title);
							}
						?>
						</select>
					</label>
				<?php
			}
		}
	}
	
	/**
	 * Googe Font Select Custom Control
	 */
	 
	if ( ! class_exists( 'Google_font_Dropdown_Custom_Control' ) ) {
		class Google_font_Dropdown_Custom_Control extends WP_Customize_Control
		{

		  private $fonts = false;

		  public function __construct( $manager, $id, $args = array(), $options = array() ) {
			$this->fonts = $this->get_fonts();
			parent::__construct( $manager, $id, $args );
		  }

		  /**
		   * Render the content of the dropdown
		   *
		   * Adding the font-family styling to the select so that the font renders 
		   * @return HTML
		   */
		  public function render_content() {
			if ( ! empty( $this->fonts ) ) { ?>
			  <label>
				<span class="customize-category-select-control"><?php echo esc_html( $this->label ); ?></span>
				<select class="select-fonts" <?php $this->link(); ?>>
				  <?php
					foreach ( $this->fonts as $k=>$v ) {
					  printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $v);
					}
				  ?>
				</select>
			  </label>
			<?php }
		  }
		  
		  /** 
		   * Get the list of fonts 
		   *
		   * @return string
		   */
		  function get_fonts() {
			$fonts = array(
				'Baloo Tamma' => 'Baloo Tamma',
				'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i' => 'Roboto',
				'Life Savers:400,700' => 'Life Savers',
				'Staatliches:400' => 'Staatliches',
				'Lily Script One:400' => 'Lily Script One',
				'Libre Baskerville:400,400i,700' => 'Libre Baskerville',
                'Open Sans:300,300i,400,400i,600,600i,700,700i,800,800i' => 'Open Sans',
				'Montserrat:100,100i,200i,300,400,500,500i,600,600i,700,700i,800,800i,900,900i' => 'Montserrat',
                'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i' => 'Poppins',
                'Arial:100,200,300,400' => 'Arial',
				'Old Standard TT:400,400i,700' => 'Old Standard TT',
				'Source Sans Pro:400,700,400i,700i' => 'Source Sans Pro',
				'Playfair Display:400,700,400i' => 'Playfair Display',
				'Oswald:200,300,400,500,600,700' => 'Oswald',
				'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,900i' => 'Raleway',
				'Droid Sans:400,700' => 'Droid Sans',
				'Lato:100,100i,300,300i,400,400i,700,700i,900,900i' => 'Lato',
				'Arvo:400,700,400i,700i' => 'Arvo',
				'Lora:400,700,400i,700i' => 'Lora',
				'Merriweather:400,300i,300,400i,700,700i' => 'Merriweather',
				'Oxygen:400,300,700' => 'Oxygen',
				'PT Serif:400,700' => 'PT Serif', 
				'PT Sans:400,700,400i,700i' => 'PT Sans',
				'PT Sans Narrow:400,700' => 'PT Sans Narrow',
				'Cabin:400,700,400i' => 'Cabin',
				'Fjalla One:400' => 'Fjalla One',
				'Francois One:400' => 'Francois One',
				'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
				'Arimo:400,700,400i,700i' => 'Arimo',
				'Ubuntu:400,700,400i,700i' => 'Ubuntu',
				'Bitter:400,700,400i' => 'Bitter',
				'Droid Serif:400,700,400i,700i' => 'Droid Serif',
				'Lobster:400' => 'Lobster',
				'Roboto:400,400i,700,700i' => 'Roboto',
				'Open Sans Condensed:700,300i,300' => 'Open Sans Condensed',
				'Roboto Condensed:400i,700i,400,700' => 'Roboto Condensed',
				'Roboto Slab:100,300,400,700' => 'Roboto Slab',
				'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
				'Mandali:400' => 'Mandali',
				'Vesper Libre:400,700' => 'Vesper Libre',
				'NTR:400' => 'NTR',
				'Dhurjati:400' => 'Dhurjati',
				'Faster One:400' => 'Faster One',
				'Mallanna:400' => 'Mallanna',
				'Averia Libre:400,300,700,400i,700i' => 'Averia Libre',
				'Galindo:400' => 'Galindo',
				'Titan One:400' => 'Titan One',
				'Abel:400' => 'Abel',
				'Nunito:400,300,700' => 'Nunito',
				'Poiret One:400' => 'Poiret One',
				'Signika:400,300,600,700' => 'Signika',
				'Muli:400,400i,300i,300' => 'Muli',
				'Play:400,700' => 'Play',
				'Bree Serif:400' => 'Bree Serif',
				'Archivo Narrow:400,400i,700,700i' => 'Archivo Narrow',
				'Cuprum:400,400i,700,700i' => 'Cuprum',
				'Noto Serif:400,400i,700,700i' => 'Noto Serif',
				'Pacifico:400' => 'Pacifico',
				'Alegreya:400,400i,700i,700,900,900i' => 'Alegreya',
				'Asap:400,400i,700,700i' => 'Asap',
				'Maven Pro:400,500,700' => 'Maven Pro',
				'Dancing Script:400,700' => 'Dancing Script',
				'Karla:400,700,400i,700i' => 'Karla',
				'Merriweather Sans:400,300,700,400i,700i' => 'Merriweather Sans',
				'Exo:400,300,400i,700,700i' => 'Exo',
				'Varela Round:400' => 'Varela Round',
				'Cabin Condensed:400,600,700' => 'Cabin Condensed',
				'PT Sans Caption:400,700' => 'PT Sans Caption',
				'Cinzel:400,700' => 'Cinzel',
				'News Cycle:400,700' => 'News Cycle',
				'Inconsolata:400,700' => 'Inconsolata',
				'Architects Daughter:400' => 'Architects Daughter',
				'Quicksand:400,700,300' => 'Quicksand',
				'Titillium Web:400,300,400i,700,700i' => 'Titillium Web',
				'Quicksand:400,700,300' => 'Quicksand',
				'Monda:400,700' => 'Monda',
				'Didact Gothic:400' => 'Didact Gothic',
				'Coming Soon:400' => 'Coming Soon',
				'Ropa Sans:400,400i' => 'Ropa Sans',
				'Tinos:400,400i,700,700i' => 'Tinos',
				'Glegoo:400,700' => 'Glegoo',
				'Pontano Sans:400' => 'Pontano Sans',
				'Fredoka One:400' => 'Fredoka One',
				'Lobster Two:400,400i,700,700i' => 'Lobster Two',
				'Quattrocento Sans:400,700,400i,700i' => 'Quattrocento Sans',
				'Covered By Your Grace:400' => 'Covered By Your Grace',
				'Changa One:400,400i' => 'Changa One',
				'Marvel:400,400i,700,700i' => 'Marvel',
				'BenchNine:400,700,300' => 'BenchNine',
				'Orbitron:400,700,500' => 'Orbitron',
				'Crimson Text:400,400i,600,700,700i' => 'Crimson Text',
				'Bangers:400' => 'Bangers',
				'Courgette:400' => 'Courgette',			
				'' => 'None',
			);
			return $fonts;
		  }		  
		}
	}
	
	/**
	 * TinyMCE Custom Control
	 *
	 */
	if ( ! class_exists( 'WP_TinyMCE_Custom_control' ) ) {
		class WP_TinyMCE_Custom_control extends WP_Customize_Control{
			public $type = 'textarea';
			/**
			** Render the content on the theme customizer page
			*/
			public function render_content() { ?>
				<label>
				  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				  <?php
					$settings = array(
						'media_buttons' => true,
						'quicktags' => true,
						'textarea_rows' => 5
					);
					$this->filter_editor_setting_link();
					wp_editor($this->value(), $this->id, $settings );
				  ?>
				</label>
			<?php
				do_action('admin_footer');
				do_action('admin_print_footer_scripts');
			}

			private function filter_editor_setting_link() {
				add_filter( 'the_editor', function( $output ) { return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 ); } );
			}
		}
	}
	
	/* Multi Input field */
	 
	class Multi_Input_Custom_control extends WP_Customize_Control{
		public $type = 'multi_input';
		public function render_content(){
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post($this->description); ?></p>
				<input type="hidden" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" value="<?php echo esc_attr($this->value()); ?>" class="customize_multi_value_field" data-customize-setting-link="<?php echo esc_attr($this->id); ?>"/>
				<div class="customize_multi_fields">
					<div class="set">
						<input type="text" value="" placeholder="Title" class="customize_multi_single_field"/>
						<a href="#" class="customize_multi_remove_field">X</a>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php esc_attr_e('Add More', 'beer_pub') ?></a>
			</label>
			<?php
		}
	}

	/**
	 * Add Option Panel
	 */

	// General
	$wp_customize->add_section( 'general_settings',
	   array(
	      'title' => esc_html__( 'General Settings','beer_pub'  ),
	      'priority' => 20, 
	   )
	);
	$wp_customize->add_setting( 'logo',
		array(
			'default' => get_template_directory_uri() . '/images/beer-pub-logo.png',
		)
	);	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'logo',
	   array(
	      'label' => esc_html__( 'Logo','beer_pub' ),
	      'description' => esc_html__( 'Upload Logo','beer_pub' ),
	      'section' => 'general_settings',
	   )
	) );
	//bg_menu
	$wp_customize->add_setting( 'Background_Menu',
		array(
			'default' => get_template_directory_uri() . '/images/menu-header-bg.jpg',
		)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Background_Menu',
	   array(
	      'label' => esc_html__( 'Background Menu','beer_pub' ),
	      'description' => esc_html__( 'Upload Background','beer_pub' ),
	      'section' => 'general_settings',
	   )
	) );
	
	$wp_customize->add_setting( 'google_font_h',
		array(
			'default' => 'Lily Script One:400',
		)
	);	
	$wp_customize->add_control( new Google_font_Dropdown_Custom_Control( $wp_customize, 'google_font_h',
	   array(
	      'label' => 'Font Family Tab H',
	      'section' => 'general_settings',
	   )
	) );
	//font H
	$wp_customize->add_setting( 'google_font_menu',
		array(
			'default' => 'Staatliches:400',
		)
	);	
	$wp_customize->add_control( new Google_font_Dropdown_Custom_Control( $wp_customize, 'google_font_menu',
	   array(
	      'label' => 'Font Main Menu',
	      'section' => 'general_settings',
	   )
	) );
	//font Menu
    $wp_customize->add_setting( 'google_font_header',
		array(
			'default' => 'Life Savers:400,700',
		)
	);
	$wp_customize->add_control( new Google_font_Dropdown_Custom_Control( $wp_customize, 'google_font_header',
	   array(
	      'label' => 'Font Main Header',
	      'section' => 'general_settings',
	   )
	) );
	//font Menu
	$wp_customize->add_setting( 'google_font_p',
		array(
			'default' => 'Libre Baskerville:400,400i,700',
		)
	);
	$wp_customize->add_control( new Google_font_Dropdown_Custom_Control( $wp_customize, 'google_font_p',
	   array(
	      'label' => 'Font Main Description',
	      'section' => 'general_settings',
	   )
	) );
	//font P
	//text left header
    $wp_customize->add_setting( 'text_left_header',
        array(
            'default' => '<p class="m-0">1-800-234-5678</p> 
                            <p class="m-0">info@craftbeers.com</p>',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control( new WP_TinyMCE_Custom_control( $wp_customize, 'text_left_header',
        array(
            'label' => esc_html__( 'Info Left Header','beer_pub' ),
            'section' => 'general_settings',
        )
    ) );
    //text right header
    $wp_customize->add_setting( 'text_right_header',
        array(
            'default' => '<p class="m-0">6589 E.Florida Ave. Tampa, Florida 333689</p>',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control( new WP_TinyMCE_Custom_control( $wp_customize, 'text_right_header',
        array(
            'label' => esc_html__( 'Info Right Header','beer_pub' ),
            'section' => 'general_settings',
        )
    ) );
	//slider
    $wp_customize->add_setting( 'slider',
        array(
            'default' => '',
        )
    );
    $wp_customize->add_control( 'slider',
        array(
            'label' => esc_html__( 'Slider','beer_pub' ),
            'section' => 'general_settings',
            'type' => 'text'
        )
    );

	// End Header
	
	// Panel Home Options
    $wp_customize->add_panel( 'home_page_setting', array(
        'priority'       => 30,
        'capability'     => 'edit_theme_options',
        'title'          => __('Home Options', 'beer_pub'),
        'description'    => __('Several settings pertaining my theme', 'beer_pub'),
    ) );

    //About US
    $wp_customize->add_section( 'about_settings',
        array(
            'title' => esc_html__( 'About section','beer_pub'  ),
            'priority' => 20,
            'panel'  => 'home_page_setting',
        )
    );
    //bg_about
    $wp_customize->add_setting( 'background_about',
        array(
            'default' => get_template_directory_uri() . '/images/about-us.jpg',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'background_about',
        array(
            'label' => esc_html__( 'Background About','beer_pub' ),
            'description' => esc_html__( 'Upload Background','beer_pub' ),
            'section' => 'about_settings',
        )
    ) );
    //Images right About
    $wp_customize->add_setting( 'img_bottom_about',
        array(
            'default' => get_template_directory_uri() . '/images/about-us-separator.png',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img_bottom_about',
        array(
            'label' => esc_html__( 'Images Bottom','beer_pub' ),
            'description' => esc_html__( 'Upload Images Right','beer_pub' ),
            'section' => 'about_settings',
        )
    ) );

    //title
    $wp_customize->add_setting( 'Title_about',
        array(
            'default' => '~ Welcome to Craft Beer Pub ~',
        )
    );
    $wp_customize->add_control( 'Title_about',
        array(
            'label' => esc_html__( 'Title','beer_pub' ),
            'section' => 'about_settings',
            'type' => 'text'
        )
    );
    //Subtitle
    //text right header
    $wp_customize->add_setting( 'desc_about',
        array(
            'default' => '  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control( new WP_TinyMCE_Custom_control( $wp_customize, 'desc_about',
        array(
            'label' => esc_html__( 'Description','beer_pub' ),
            'section' => 'about_settings',
        )
    ) );
	 //title Link
    $wp_customize->add_setting( 'Title_link_about',
        array(
            'default' => 'read more',
        )
    );
    $wp_customize->add_control( 'Title_link_about',
        array(
            'label' => esc_html__( 'Title Link','beer_pub' ),
            'section' => 'about_settings',
            'type' => 'text'
        )
    );
    //link
    $wp_customize->add_setting( 'link_about',
        array(
            'default' => '#',
        )
    );
    $wp_customize->add_control( 'link_about',
        array(
            'label' => esc_html__( 'Link About','beer_pub' ),
            'section' => 'about_settings',
            'type' => 'text'
        )
    );
    //Show/Hide session
    $wp_customize->add_setting( 'about_show',
        array(
            'default' => 'yes',
        )
    );
    $wp_customize->add_control( 'about_show',
        array(
            'label' => esc_html__( 'Show Section','beer_pub' ),
            'section' => 'about_settings',
            'type' => 'select',
            'choices' => array(
                'no' => esc_html__( 'No','beer_pub' ),
                'yes' => esc_html__( 'Yes','beer_pub' ),
            )
        )
    );
    //and about
    //the pub
    $wp_customize->add_section( 'the_pub_settings',
        array(
            'title' => esc_html__( 'The Pub Section','beer_pub'  ),
            'priority' => 20,
            'panel'  => 'home_page_setting',
        )
    );
    //title
    $wp_customize->add_setting( 'title_the_pub',
        array(
            'default' => '~Feel The Taste of our Beer ~',
        )
    );
    $wp_customize->add_control( 'title_the_pub',
        array(
            'label' => esc_html__( 'Title','beer_pub' ),
            'section' => 'the_pub_settings',
            'type' => 'text'
        )
    );
    //sub title
    $wp_customize->add_setting( 'sub_title_the_pub',
        array(
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
        )
    );
    $wp_customize->add_control( 'sub_title_the_pub',
        array(
            'label' => esc_html__( 'Sub Title','beer_pub' ),
            'section' => 'the_pub_settings',
            'type' => 'text'
        )
    );

    //  Category Dropdown
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->term_id;
            $i++;
        }
        $cats[$category->term_id] = $category->name;
    }

    $wp_customize->add_setting( 'The_pub_category',
        array(
            'default' => $default,
        )
    );
    $wp_customize->add_control('The_pub_category',
        array(
            'label' => esc_html__( 'Category Post','beer_pub' ),
            'section' => 'the_pub_settings',
            'type' => 'select',
            'choices' => $cats,
        )
    );

    //Number post
    $wp_customize->add_setting( 'the_pub_number_post',
        array(
            'default' => esc_html__('3','beer_pub'),
        )
    );
    $wp_customize->add_control('the_pub_number_post',
        array(
            'label' => esc_html__( 'Number Post','beer_pub' ),
            'section' => 'the_pub_settings',
            'type' => 'text',
        )
    );
    //Show/Hide session
    $wp_customize->add_setting( 'the_pub_show',
        array(
            'default' => 'yes',
        )
    );
    $wp_customize->add_control( 'the_pub_show',
        array(
            'label' => esc_html__( 'Show Section','beer_pub' ),
            'section' => 'the_pub_settings',
            'type' => 'select',
            'choices' => array(
                'no' => esc_html__( 'No','beer_pub' ),
                'yes' => esc_html__( 'Yes','beer_pub' ),
            )
        )
    );
    //and the pub
    //our-brewery
    $wp_customize->add_section( 'our_brewery_settings',
        array(
            'title' => esc_html__( 'Our Brewery section','beer_pub'  ),
            'priority' => 20,
            'panel'  => 'home_page_setting',
        )
    );
    //title
    $wp_customize->add_setting( 'title_our_brewery',
        array(
            'default' => '~We serve variety of Beers~',
        )
    );
    $wp_customize->add_control( 'title_our_brewery',
        array(
            'label' => esc_html__( 'Title','beer_pub' ),
            'section' => 'our_brewery_settings',
            'type' => 'text'
        )
    );
    //sub title
    $wp_customize->add_setting( 'sub_title_our_brewery',
        array(
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
        )
    );
    $wp_customize->add_control( 'sub_title_our_brewery',
        array(
            'label' => esc_html__( 'Sub Title','beer_pub' ),
            'section' => 'our_brewery_settings',
            'type' => 'text'
        )
    );
    //Backgrond our_brewery
    $wp_customize->add_setting( 'Background_our_brewery',
        array(
            'default' => get_template_directory_uri() . '/images/our-brewery.jpg',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Background_our_brewery',
        array(
            'label' => esc_html__( 'Background','beer_pub' ),
            'description' => esc_html__( 'Upload Images Right','beer_pub' ),
            'section' => 'our_brewery_settings',
        )
    ) );
    //Images
    $wp_customize->add_setting( 'img_title',
        array(
            'default' => get_template_directory_uri() . '/images/our-brewery-separator.png',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img_title',
        array(
            'label' => esc_html__( 'Images Bottom Title','beer_pub' ),
            'description' => esc_html__( 'Upload Images Right','beer_pub' ),
            'section' => 'our_brewery_settings',
        )
    ) );
    //  Category Dropdown
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->term_id;
            $i++;
        }
        $cats[$category->term_id] = $category->name;
    }

    $wp_customize->add_setting( 'our_brewery_category',
        array(
            'default' => $default,
        )
    );
    $wp_customize->add_control('our_brewery_category',
        array(
            'label' => esc_html__( 'Category Post','beer_pub' ),
            'section' => 'our_brewery_settings',
            'type' => 'select',
            'choices' => $cats,
        )
    );

    //Number post
    $wp_customize->add_setting( 'our_brewery_number_post',
        array(
            'default' => esc_html__('4','beer_pub'),
        )
    );
    $wp_customize->add_control('our_brewery_number_post',
        array(
            'label' => esc_html__( 'Number Post','beer_pub' ),
            'section' => 'our_brewery_settings',
            'type' => 'text',
        )
    );
//Show/Hide session
    $wp_customize->add_setting( 'our_brewery_show',
        array(
            'default' => 'yes',
        )
    );
    $wp_customize->add_control( 'our_brewery_show',
        array(
            'label' => esc_html__( 'Show Section','beer_pub' ),
            'section' => 'our_brewery_settings',
            'type' => 'select',
            'choices' => array(
                'no' => esc_html__( 'No','beer_pub' ),
                'yes' => esc_html__( 'Yes','beer_pub' ),
            )
        )
    );
    //and our-brewery
    //rates
    $wp_customize->add_section( 'rates_settings',
        array(
            'title' => esc_html__( 'Rates section','beer_pub'  ),
            'priority' => 20,
            'panel'  => 'home_page_setting',
        )
    );


    //title
    $wp_customize->add_setting( 'title_rates',
        array(
            'default' => '~ Our Beer Lists & Rates ~',
        )
    );
    $wp_customize->add_control( 'title_rates',
        array(
            'label' => esc_html__( 'Title','beer_pub' ),
            'section' => 'rates_settings',
            'type' => 'text'
        )
    );
    //sub title
    $wp_customize->add_setting( 'sub_title_rates',
        array(
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
        )
    );
    $wp_customize->add_control( 'sub_title_rates',
        array(
            'label' => esc_html__( 'Sub Title','beer_pub' ),
            'section' => 'rates_settings',
            'type' => 'text'
        )
    );
    //Backgrond our_brewery
    $wp_customize->add_setting( 'Background_rates',
        array(
            'default' => get_template_directory_uri() . '/images/rate-bg.jpg',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Background_rates',
        array(
            'label' => esc_html__( 'Background','beer_pub' ),
            'description' => esc_html__( 'Upload Images Right','beer_pub' ),
            'section' => 'rates_settings',
        )
    ) );
    //img our_brewery
    $wp_customize->add_setting( 'img_rates',
        array(
            'default' => get_template_directory_uri() . '/images/rate-separate.png',
        )
    );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img_rates',
        array(
            'label' => esc_html__( 'Images Rate','beer_pub' ),
            'description' => esc_html__( 'Upload Images Right','beer_pub' ),
            'section' => 'rates_settings',
        )
    ) );
    //feeback
    //  Category Dropdown
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->term_id;
            $i++;
        }
        $cats[$category->term_id] = $category->name;
    }

    $wp_customize->add_setting( 'rates_category',
        array(
            'default' => $default,
        )
    );
    $wp_customize->add_control('rates_category',
        array(
            'label' => esc_html__( 'Category Post','beer_pub' ),
            'section' => 'rates_settings',
            'type' => 'select',
            'choices' => $cats,
        )
    );

    //Number post
    $wp_customize->add_setting( 'rates_number_post',
        array(
            'default' => esc_html__('3','beer_pub'),
        )
    );
    $wp_customize->add_control('rates_number_post',
        array(
            'label' => esc_html__( 'Number Post','beer_pub' ),
            'section' => 'rates_settings',
            'type' => 'text',
        )
    );
    //mullti
    $wp_customize->add_setting( 'customizer_repeater_rates', array(
        'sanitize_callback' => 'customizer_repeater_sanitize'
    ));
    $wp_customize->add_control( new Customizer_Repeater( $wp_customize, 'customizer_repeater_rates', array(
        'label'   => esc_html__('Rates Details','customizer-repeater'),
        'section' => 'rates_settings',
        'customizer_repeater_title_control' => true,
        'customizer_repeater_link_control' => true,
        'customizer_repeater_subtitle_control' => true,
//        'customizer_repeater_price_control' => true,
        'customizer_repeater_text_control' => true,
        'customizer_repeater_repeater_control' => true
    ) ) );
    //Show/Hide session
    $wp_customize->add_setting( 'rates_show',
        array(
            'default' => 'yes',
        )
    );
    $wp_customize->add_control( 'rates_show',
        array(
            'label' => esc_html__( 'Show Section','beer_pub' ),
            'section' => 'rates_settings',
            'type' => 'select',
            'choices' => array(
                'no' => esc_html__( 'No','beer_pub' ),
                'yes' => esc_html__( 'Yes','beer_pub' ),
            )
        )
    );
    //end rates
    //blog
    $wp_customize->add_section( 'blog_settings',
        array(
            'title' => esc_html__( 'Blog section','beer_pub'  ),
            'priority' => 20,
            'panel'  => 'home_page_setting',
        )
    );
    //title
    $wp_customize->add_setting( 'Bolg_title',
        array(
            'default' => '~ Lates Posts from Blog ~',
        )
    );
    $wp_customize->add_control( 'Bolg_title',
        array(
            'label' => esc_html__( 'Title','beer_pub' ),
            'section' => 'blog_settings',
            'type' => 'text'
        )
    );
    //subTitle
    $wp_customize->add_setting( 'blog_sub_title',
        array(
            'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.',
        )
    );
    $wp_customize->add_control( 'blog_sub_title',
        array(
            'label' => esc_html__( 'Title Sub','beer_pub' ),
            'section' => 'blog_settings',
            'type' => 'text'
        )
    );
    //  Category Dropdown
    $categories = get_categories();
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->term_id;
            $i++;
        }
        $cats[$category->term_id] = $category->name;
    }

    $wp_customize->add_setting( 'blog_category',
        array(
            'default' => $default,
        )
    );
    $wp_customize->add_control('blog_category',
        array(
            'label' => esc_html__( 'Category Post','beer_pub' ),
            'section' => 'blog_settings',
            'type' => 'select',
            'choices' => $cats,
        )
    );

    //Number post
    $wp_customize->add_setting( 'blog_number_post',
        array(
            'default' => esc_html__('3','beer_pub'),
        )
    );
    $wp_customize->add_control('blog_number_post',
        array(
            'label' => esc_html__( 'Number Post','beer_pub' ),
            'section' => 'blog_settings',
            'type' => 'text',
        )
    );
    //Show/Hide session
    $wp_customize->add_setting( 'blog_show',
        array(
            'default' => 'yes',
        )
    );
    $wp_customize->add_control( 'blog_show',
        array(
            'label' => esc_html__( 'Show Section','beer_pub' ),
            'section' => 'blog_settings',
            'type' => 'select',
            'choices' => array(
                'no' => esc_html__( 'No','beer_pub' ),
                'yes' => esc_html__( 'Yes','beer_pub' ),
            )
        )
    );

    //andblog




    //contact Session
    $wp_customize->add_section( 'contact_settings',
        array(
            'title' => esc_html__( 'Contact section','beer_pub'  ),
            'priority' => 20,
            'panel'  => 'home_page_setting',
        )
    );
    //map
    $wp_customize->add_setting( 'map_contact',
        array(
            'default' => esc_html__('','beer_pub'),
        )
    );
    $wp_customize->add_control('map_contact',
        array(
            'label' => esc_html__( 'Map Contact','beer_pub' ),
            'section' => 'contact_settings',
            'type' => 'textarea',
        )
    );

//Contact shortcode

    $wp_customize->add_setting( 'desc_contact',
        array(
            'default' => '    <a href="mailto:info@craftbeerpub.com">info@craftbeerpub.com</a>
                                <p>Craft Beer Pub  LLC</p>
                                <p>85 Broad Street</p>
                                <p>28th Floor</p>
                                <p>New York, NY 10004</p>
                                <a href="tel:8001233456">(800) 123 - 3456</a>',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    $wp_customize->add_control( new WP_TinyMCE_Custom_control( $wp_customize, 'desc_contact',
        array(
            'label' => esc_html__( 'info contact','beer_pub' ),
            'section' => 'contact_settings',
        )
    ) );
    //Show/Hide session
    $wp_customize->add_setting( 'contact_show',
        array(
            'default' => 'yes',
        )
    );
    $wp_customize->add_control( 'contact_show',
        array(
            'label' => esc_html__( 'Show Section','beer_pub' ),
            'section' => 'contact_settings',
            'type' => 'select',
            'choices' => array(
                'no' => esc_html__( 'No','beer_pub' ),
                'yes' => esc_html__( 'Yes','beer_pub' ),
            )
        )
    );

    //End Donate


	// End Home Options
	
	// Footer
	$wp_customize->add_section( 'footer_settings',
	   array(
	      'title' => esc_html__( 'Footer Settings','beer_pub'  ),
	      'priority' => 35, 
	   )
	);

	$wp_customize->add_setting( 'copyright',
		array(
			'default' => '<p>(C) 2018. AllRights Reserved. Divine Makeup Artist. Designed by <a href="#">Template.net</a></p>',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control( new WP_TinyMCE_Custom_control( $wp_customize, 'copyright',
	   array(
	      'label' => esc_html__( 'Copyright text','beer_pub' ),
	      'section' => 'footer_settings',
	   )
	) );

	//end footer

	// Social	
	$wp_customize->add_section( 'social_settings',
	   array(
	      'title' => esc_html__( 'Social','beer_pub'  ),
	      'priority' => 35, 
	   )
	);
	$wp_customize->add_setting( 'show_social',
	   array(
	      'default' => 'yes',
	   )
	);	
	$wp_customize->add_control( 'show_social',
	   array(
	      'label' => esc_html__( 'Show Social','beer_pub' ),
	      'section' => 'social_settings',
	      'type' => 'select',
	      'choices' => array( // Optional.
	         'no' => esc_html__( 'No','beer_pub' ),
	         'yes' => esc_html__( 'Yes','beer_pub' ),
	      )
	   )
	);		

	$social_links = array(
		'facebook' => esc_html__('Facebook','beer_pub'),
		'instagram'=> esc_html__('Instagram','beer_pub'),
		'twitter'=> esc_html__('Twitter','beer_pub'),
		'google'=> esc_html__('Google','beer_pub'),
		'linkedin'=> esc_html__('Linkedin','beer_pub')
	);	
	foreach ($social_links as $key => $value) {
		$wp_customize->add_setting( $key,
		   array(
		      'default' => '#',
		   )
		);	
		$wp_customize->add_control( $key,
		   array(
		      'label' => esc_html( $value),
		      'section' => 'social_settings',
		      'type' => 'text',
		   )
		);	
	}	
	foreach ($social_links as $key => $value) {
			$wp_customize->add_setting( 'share_'.$key,
			   array(
				  'default' => 'yes',
			   )
			);		
		$wp_customize->add_control( 'share_'.$key,
		   array(
		      'label' => esc_html( 'Share '.$value),
		      'section' => 'social_settings',
			  'type' => 'select',
			  'choices' => array( // Optional.
				 'no' => esc_html__( 'No','beer_pub' ),
				 'yes' => esc_html__( 'Yes','beer_pub' ),
			  )
		   )
		);	
	}

	// Blog
	$wp_customize->add_section( 'blog_page_settings',
	   array(
	      'title' => esc_html__( 'Blog Settings','beer_pub'  ),
	      'priority' => 35, 
	   )
	);	 
	$wp_customize->add_setting('blog_page_title',
	   array(
	      'default' => esc_html__('Blog Articles','beer_pub'),
	   )
	);    
   	$wp_customize->add_control( 'blog_page_title',
	   array(
	      'label' => esc_html__( 'Blog page Title','beer_pub' ),
	      'section' => 'blog_page_settings',
	      'type' => 'text',
	   )
	);
	
    $wp_customize->add_setting( 'blog_single_related',
	   array(
	      'default' => 'yes',
	   )
	);

	$wp_customize->add_control( 'blog_single_related',
	   	array(
	      'label' => esc_html__( 'Related Posts','beer_pub' ),
	      'section' => 'blog_page_settings',
	      'type' => 'select',
	      'choices' => array( 
	         'no' => esc_html__( 'No','beer_pub' ),
	         'yes' => esc_html__( 'Yes','beer_pub' ),
	      )
	    )
	);
	
	$wp_customize->add_setting( 'show_loadmore_blog',
	   array(
	      'default' => 'no',
	   )
	);	
	$wp_customize->add_control( 'show_loadmore_blog',
	   array(
	      'label' => esc_html__( 'Show Loadmore','beer_pub' ),
	      'section' => 'blog_page_settings',
	      'type' => 'select',
	      'choices' => array( // Optional.
	         'no' => esc_html__( 'No','beer_pub' ),
	         'yes' => esc_html__( 'Yes','beer_pub' ),
	      )
	   )
	);
}




















/**
 * Theme options in the Customizer js
 * @package beer_pub
 */

function editor_customizer_script() {
    wp_enqueue_script( 'wp-editor-customizer', get_template_directory_uri() . '/inc/admin/js/customizer.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'customizer_repeater', get_template_directory_uri() . '/inc/class/customizer_repeater.js', array( 'jquery' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'editor_customizer_script' );

add_action( 'admin_menu', 'beer_pub_customize_admin_menu_hide', 999 );
function beer_pub_customize_admin_menu_hide(){
    global $submenu;

    // Remove Appearance - Customize Menu
    unset( $submenu[ 'themes.php' ][ 6 ] );

    // Create URL.
    $customize_url = add_query_arg(
        'return',
        urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
        'customize.php'
    );
    // Add sub menu page to the Dashboard menu.
    add_dashboard_page(
        '<div class="beer_pub-theme-options"><span>'.esc_html__( 'beer_pub','beer_pub' ).'</span>'.esc_html__( 'Theme Options','beer_pub' ).'</div>',
         '<div class="beer_pub-theme-options"><span>'.esc_html__( 'beer_pub','beer_pub' ).'</span>'.esc_html__( 'Theme Options','beer_pub' ).'</div>',
        'customize',
        esc_url( $customize_url ),
        ''
    );
}

function customizer_repeater_sanitize($input){
	$input_decoded = json_decode($input,true);

	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){

					$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );

			}
		}
		return json_encode($input_decoded);
	}
	return $input;
}