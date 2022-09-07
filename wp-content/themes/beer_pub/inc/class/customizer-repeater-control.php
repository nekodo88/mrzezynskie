<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

class Customizer_Repeater extends WP_Customize_Control {

	public $id;
	private $boxtitle = array();
	private $add_field_label = array();
	private $customizer_icon_container = '';
	private $allowed_html = array();
	public $customizer_repeater_title_control = false;
	public $customizer_repeater_subtitle_control = false;
	public $customizer_repeater_link_control = false;
	public $customizer_repeater_price_control = false;
	public $customizer_repeater_text_control = false;
	public $customizer_repeater_repeater_control = false;



	/*Class constructor*/
	public function __construct( $manager, $id, $args = array() ) {
		parent::__construct( $manager, $id, $args );
		/*Get options from customizer.php*/
		$this->add_field_label = esc_html__( 'Add new field', 'beer_pub' );
		if ( ! empty( $args['add_field_label'] ) ) {
			$this->add_field_label = $args['add_field_label'];
		}

		$this->boxtitle = esc_html__( 'Customizer Repeater', 'beer_pub' );
		if ( ! empty ( $args['item_name'] ) ) {
			$this->boxtitle = $args['item_name'];
		} elseif ( ! empty( $this->label ) ) {
			$this->boxtitle = $this->label;
		}

		if ( ! empty( $args['customizer_repeater_title_control'] ) ) {
			$this->customizer_repeater_title_control = $args['customizer_repeater_title_control'];
		}

		if ( ! empty( $args['customizer_repeater_repeater_control'] ) ) {
			$this->customizer_repeater_repeater_control = $args['customizer_repeater_repeater_control'];
		}

		if ( ! empty( $id ) ) {
			$this->id = $id;
		}

		if ( file_exists( get_template_directory() . '/customizer-repeater/inc/icons.php' ) ) {
			$this->customizer_icon_container =  'customizer-repeater/inc/icons';
		}

		$allowed_array1 = wp_kses_allowed_html( 'post' );
		$allowed_array2 = array(
			'input' => array(
				'type'        => array(),
				'class'       => array(),
				'placeholder' => array()
			)
		);

		$this->allowed_html = array_merge( $allowed_array1, $allowed_array2 );
	}

	public function render_content() {

		/*Get default options*/
		$this_default = json_decode( $this->setting->default );

		/*Get values (json format)*/
		$values = $this->value();

		/*Decode values*/
		$json = json_decode( $values );

		if ( ! is_array( $json ) ) {
			$json = array( $values );
		} ?>

        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
			<?php
			if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
				if ( ! empty( $this_default ) ) {
					$this->iterate_array( $this_default ); ?>
                    <input type="hidden"
                           id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                           class="customizer-repeater-colector"
                           value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
					<?php
				} else {
					$this->iterate_array(); ?>
                    <input type="hidden"
                           id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                           class="customizer-repeater-colector"/>
					<?php
				}
			} else {
				$this->iterate_array( $json ); ?>
                <input type="hidden" id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                       class="customizer-repeater-colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
				<?php
			} ?>
        </div>
        <button type="button" class="button add_field customizer-repeater-new-field">
			<?php echo esc_html( $this->add_field_label ); ?>
        </button>
		<?php
	}

	private function iterate_array($array = array()){
		/*Counter that helps checking if the box is first and should have the delete button disabled*/
		$it = 0;
		if(!empty($array)){
			foreach($array as $icon){ ?>
                <div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
                    <div class="customizer-repeater-customize-control-title">
						<?php echo esc_html( $this->boxtitle ) ?>
                    </div>
                    <div class="customizer-repeater-box-content-hidden">
						<?php
						$choice = $image_url = $icon_value = $title = $subtitle = $text = $text2  = $link2 = $link = $shortcode = $repeater = $color = $color2 = '';
						if(!empty($icon->id)){
							$id = $icon->id;
						}
						if(!empty($icon->title)){
							$title = $icon->title;
						}
						if(!empty($icon->subtitle)){
							$subtitle =  $icon->subtitle;
						}
						if(!empty($icon->link)){
							$link =  $icon->link;
						}
						if(!empty($icon->icon_value)){
                            $icon_value = $icon->icon_value;
						}
						if(!empty($icon->text)){
                            $text = $icon->text;
						}
						if($this->customizer_repeater_title_control==true){
							$this->input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title','beer_pub' ), $this->id, 'customizer_repeater_title_control' ),
								'class' => 'customizer-repeater-title-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
							), $title);
						}
                        if($this->customizer_repeater_link_control==true){
                            $this->input_control(array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','beer_pub' ), $this->id, 'customizer_repeater_link_control' ),
                                'class' => 'customizer-repeater-link-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
                            ), $link);
                        }
						if($this->customizer_repeater_subtitle_control==true){
							$this->input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Sub Title','beer_pub' ), $this->id, 'customizer_repeater_subtitle_control' ),
								'class' => 'customizer-repeater-subtitle-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
							), $subtitle);
						}

						if($this->customizer_repeater_price_control==true){
							$this->input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Text','beer_pub' ), $this->id, 'customizer_repeater_price_control' ),
								'class' => 'customizer-repeater-price-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_price_control' ),
							), $icon_value);
						}
						if($this->customizer_repeater_text_control==true){
							$this->input_control(array(
								'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Price','beer_pub' ), $this->id, 'customizer_repeater_text_control' ),
								'class' => 'customizer-repeater-text-control',
								'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_text_control' ),
							), $text);
						}

						if($this->customizer_repeater_repeater_control==true){
							$this->repeater_control($repeater);
						} ?>

                        <input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $id ) ) {
							echo esc_attr( $id );
						} ?>">
                        <button type="button" class="social-repeater-general-control-remove-field" <?php if ( $it == 0 ) {
							echo 'style="display:none;"';
						} ?>>
							<?php esc_html_e( 'Delete field', 'beer_pub' ); ?>
                        </button>

                    </div>
                </div>

				<?php
				$it++;
			}
		} else { ?>
            <div class="customizer-repeater-general-control-repeater-container">
                <div class="customizer-repeater-customize-control-title">
					<?php echo esc_html( $this->boxtitle ) ?>
                </div>
                <div class="customizer-repeater-box-content-hidden">
					<?php

					if ( $this->customizer_repeater_title_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title','beer_pub' ), $this->id, 'customizer_repeater_title_control' ),
							'class' => 'customizer-repeater-title-control',
							'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_title_control' ),
						) );
					}
                    if ( $this->customizer_repeater_link_control == true ) {
                        $this->input_control( array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','beer_pub' ), $this->id, 'customizer_repeater_link_control' ),
                            'class' => 'customizer-repeater-link-control',
                            'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_link_control' ),
                        ) );
                    }
					if ( $this->customizer_repeater_subtitle_control == true ) {
						$this->input_control( array(
							'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Sub Tile','beer_pub' ), $this->id, 'customizer_repeater_subtitle_control' ),
							'class' => 'customizer-repeater-subtitle-control',
							'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_subtitle_control' ),
						) );
					}
                    if($this->customizer_repeater_price_control==true){
                        $this->input_control(array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Price','beer_pub' ), $this->id, 'customizer_repeater_price_control' ),
                            'class' => 'customizer-repeater-price-control',
                            'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_price_control' ),
                        ));
                    }
                    if($this->customizer_repeater_text_control==true){
                        $this->input_control(array(
                            'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Text','beer_pub' ), $this->id, 'customizer_repeater_text_control' ),
                            'class' => 'customizer-repeater-text-control',
                            'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'customizer_repeater_text_control' ),
                        ));
                    }
					if($this->customizer_repeater_repeater_control==true){
						$this->repeater_control();
					} ?>
                    <input type="hidden" class="social-repeater-box-id">
                    <button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
						<?php esc_html_e( 'Delete field', 'beer_pub' ); ?>
                    </button>
                </div>
            </div>
			<?php
		}
	}

	private function input_control( $options, $value='' ){ ?>

		<?php
		if( !empty($options['type']) ){
			switch ($options['type']) {
				case 'textarea':?>
                    <span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
                    <textarea class="<?php echo esc_attr( $options['class'] ); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"><?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?></textarea>
					<?php
					break;
				case 'color':
					$style_to_add = '';
					if( $options['choice'] !== 'customizer_repeater_icon' ){
						$style_to_add = 'display:none';
					}?>
                    <span class="customize-control-title" <?php if( !empty( $style_to_add ) ) { echo 'style="'.esc_attr( $style_to_add ).'"';} ?>><?php echo esc_html( $options['label'] ); ?></span>
                    <div class="<?php echo esc_attr($options['class']); ?>" <?php if( !empty( $style_to_add ) ) { echo 'style="'.esc_attr( $style_to_add ).'"';} ?>>
                        <input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
                    </div>
					<?php
					break;
			}
		} else { ?>
            <span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
            <input type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo esc_attr( $options['label'] ); ?>"/>
			<?php
		}
	}

	private function icon_picker_control($value = '', $show = ''){
		?>
        <div class="social-repeater-general-control-icon" <?php if( $show === 'customizer_repeater_image' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Icon','beer_pub'); ?>
            </span>
            <span class="description customize-control-description">
                <?php
                echo sprintf(
	                esc_html__( 'Note: Some icons may not be displayed here. You can see the full list of icons at %1$s.', 'beer_pub' ),
	                sprintf( '<a href="http://fontawesome.io/icons/" rel="nofollow">%s</a>', esc_html__( 'http://fontawesome.io/icons/', 'beer_pub' ) )
                ); ?>
            </span>
            <div class="input-group icp-container">
                <input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value );} ?>" type="text">
                <span class="input-group-addon">
                    <i class="fa <?php echo esc_attr($value); ?>"></i>
                </span>
            </div>
			<?php get_template_part( $this->customizer_icon_container ); ?>
        </div>
		<?php
	}

	private function image_control($value = '', $show = ''){ ?>
        <div class="customizer-repeater-image-control" <?php if( $show === 'customizer_repeater_icon' || $show === 'customizer_repeater_none' || empty( $show ) ) { echo 'style="display:none;"'; } ?>>
            <span class="customize-control-title">
                <?php esc_html_e('Image','beer_pub')?>
            </span>
            <input type="text" class="widefat custom-media-url" value="<?php echo esc_attr( $value ); ?>">
            <input type="button" class="button button-secondary customizer-repeater-custom-media-button" value="<?php esc_attr_e( 'Upload Image','beer_pub' ); ?>" />
        </div>
		<?php
	}

	private function icon_type_choice($value='customizer_repeater_icon'){ ?>
        <span class="customize-control-title">
            <?php esc_html_e('Image type','beer_pub');?>
        </span>
        <select class="customizer-repeater-image-choice">
            <option value="customizer_repeater_icon" <?php selected($value,'customizer_repeater_icon');?>><?php esc_html_e('Icon','beer_pub'); ?></option>
            <option value="customizer_repeater_image" <?php selected($value,'customizer_repeater_image');?>><?php esc_html_e('Image','beer_pub'); ?></option>
            <option value="customizer_repeater_none" <?php selected($value,'customizer_repeater_none');?>><?php esc_html_e('None','beer_pub'); ?></option>
        </select>
		<?php
	}

	private function repeater_control($value = ''){
		$social_repeater = array();
		$show_del        = 0;
		if(!empty($value)) {
			$social_repeater = json_decode( html_entity_decode( $value ), true );
		}
		if ( ( count( $social_repeater ) == 1 && '' === $social_repeater[0] ) || empty( $social_repeater ) ) { ?>
            <div class="customizer-repeater-social-repeater">
                <div class="customizer-repeater-social-repeater-container">
					<?php get_template_part( $this->customizer_icon_container ); ?>
                    <input type="hidden" class="customizer-repeater-social-repeater-id" value="">
                    <button class="social-repeater-remove-social-item" style="display:none">
						<?php esc_html_e( 'Remove Icon', 'beer_pub' ); ?>
                    </button>
                </div>
                <input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value=""/>
            </div>
		<?php }
	}
}
